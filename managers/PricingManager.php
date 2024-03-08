<?php

class PricingManager extends AbstractManager
{

    public function createPricing(Pricing $pricing): void
    {
        $query = $this->db->prepare('INSERT INTO pricings (id, contactMode, firstname, lastname, email, tel, city, details, pricing, photoPath) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city,:details, :pricing, :photoPath)');
        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel,
            "city" => $pricing->getCity(),
            "details" => $pricing->getDetails(),
            "pricing" => $pricing->getPricing(),
            "photoPath" => $pricing->getPhotoPath()
        ];
        $query->execute($parameters);
        $pricing->setId($this->db->lastInsertId());
    }

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM pricings');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pricings = [];

        foreach ($result as $item) {
            $pricing= new Pricing($item["contactMode"], $item["firstname"], $item["lastname"], $item["email"], $item["tel"], $item["city"], $item["details"], $item["pricing"], $item["photoPath"]);
            $pricing->setId($item["id"]);
            $pricings[] = $pricing;
        }
        return $pricings;
    }


    public function getPricingById(int $id): ?Pricing
    {
        $query = $this->db->prepare('SELECT * FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["details"], $result["pricing"], $result["photoPath"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function createPricing(Pricing $pricing): void
    {
        $query = $this->db->prepare('INSERT INTO pricings (id, contactMode, firstname, lastname, email, tel, city, details, pricing, photoPath) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city,:details, :pricing, :photoPath');
        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel,
            "city" => $pricing->getCity(),
            "details" => $pricing->getDetails(),
            "pricing" => $pricing->getPricing(),
            "photoPath" => $pricing->getPhotoPath()
        ];
        $query->execute($parameters);
        $pricing->setId($this->db->lastInsertId());
    }

    public function updatePricing(Pricing $pricing): void
    {
        $query = $this->db->prepare('UPDATE pricings SET id, contactMode, firstname, lastname, email, tel, city, details, pricing, photoPath) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city,:details, :pricing, :photoPath');
        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel,
            "city" => $pricing->getCity(),
            "details" => $pricing->getDetails(),
            "pricing" => $pricing->getPricing(),
            "photoPath" => $pricing->getPhotoPath()
        ];
        $query->execute($parameters);
    }

    public function deletePricing(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);
    }
}


