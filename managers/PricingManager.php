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
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["message"], $result["photoPath"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function createPricing(Pricing $pricing): ?Pricing
    {
        /*if(isset($_POST["formName"]))
        {
            $uploader = new Uploader();
            $media = $uploader->upload($_FILES, "image");
            var_dump($media);
        }*/
            $query = $this->db->prepare('INSERT INTO pricings (id, contactMode, firstname, lastname, email, tel, city, message) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city, :message)');
            $parameters = [
                "contactMode" => $pricing->getContactMode(),
                "firstname" => $pricing->getFirstname(),
                "lastname" => $pricing->getLastname(),
                "email" => $pricing->getEmail(),
                "tel" => $pricing->getTel(),
                "city" => $pricing->getCity(),
                "message" => $pricing->getMessage(),
               /* "photo" => $this->saveUploadedFile($_FILES["photo"])*/
            ];

            if ($query->errorCode() !== '00000')
            {
                $errorInfo = $query->errorInfo();
                dump($errorInfo);
            }
            $query->execute($parameters);
            $pricing->setId($this->db->lastInsertId());

            return $pricing;
        }

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM pricings');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pricings = [];

        foreach ($result as $item) {
            $pricing = new Pricing($item["contactMode"], $item["firstname"], $item["lastname"], $item["email"], $item["tel"], $item["city"], $item["details"], $item["pricing"], $item["photo"]);
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

        if ($result) {
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["details"], $result["pricing"], $result["photo"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function updatePricing(Pricing $pricing): void
    {
        $details1 = $_POST['details'];

        for ($i = 0; $i < sizeof($details1); $i++) {
            $query = $this->db->prepare('UPDATE pricings SET contactMode = :contactMode, firstname = :firstname, lastname = :lastname, email = :email, tel = :tel, city = :city, details = :details, message = :message, photo = :photo WHERE id = :id');

        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel(),
            "city" => $pricing->getCity(),
            "details" => $details1[$i],
            "message" => $pricing->getMessage(),
            "photo" => $this->saveUploadedFile($_FILES["photo"])
        ];
        $query->execute($parameters);
        }
    }

    public function deletePricing(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);
    }
}


