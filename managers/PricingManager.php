<?php

class PricingManager extends AbstractManager
{
    public function findOne(int $id) : ? Pricing
    {
        $query = $this->db->prepare('SELECT * FROM pricings WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $dm = new DetailManager();
            $details = $dm->findByPricing($result['id']);
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["message"], $details, $result["photoPath"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function createPricing(Pricing $pricing): void
    {
            $query = $this->db->prepare('INSERT INTO pricings (id, contactMode, firstname, lastname, email, tel, city, message, photoPath) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city, :message, :photoPath)');
            $parameters = [
                "contactMode" => $pricing->getContactMode(),
                "firstname" => $pricing->getFirstname(),
                "lastname" => $pricing->getLastname(),
                "email" => $pricing->getEmail(),
                "tel" => $pricing->getTel(),
                "city" => $pricing->getCity(),
                "message" => $pricing->getMessage(),
                "photoPath" => $pricing->getPhotoPath()
            ];

            if ($query->errorCode() !== '00000')
            {
                $errorInfo = $query->errorInfo();
//                dump($errorInfo);
            }
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
            $dm = new DetailManager();
            $details = $dm->findByPricing($item['id']);
            $pricing = new Pricing($item["contactMode"], $item["firstname"], $item["lastname"], $item["email"], $item["tel"], $item["city"], $item["message"], $details, $item["photoPath"]);

            $pricings[] = $pricing;
        }
        return $pricings;
    }

    public function getPricingById(int $id): ?Pricing
    {
        $query = $this->db->prepare('SELECT * FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        dump($result);

        if ($result) {
            $dm = new DetailManager();
            $details = $dm->findByPricing($result['id']);
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["message"], $result["photoPath"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function deletePricing(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);
    }
}


