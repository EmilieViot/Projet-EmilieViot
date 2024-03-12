<?php

class PricingManager extends AbstractManager
{
    private function saveUploadedFile($file) {
        $uploadsDirectory = 'uploads/';

        // Générez un nom unique pour le fichier
        $fileName = uniqid() . '_' . basename($file['photo']);

        // Déplacez le fichier vers le dossier d'uploads
        $targetPath = $uploadsDirectory . $fileName;
        move_uploaded_file($file['tmp_name'], $targetPath);

        // Retournez le chemin du fichier sauvegardé
        return $targetPath;
    }

    public function createPricing(Pricing $pricing): void
    {
        $query = $this->db->prepare('INSERT INTO pricings (id, contactMode, firstname, lastname, email, tel, city, details, message, photo) VALUES (NULL, :contactMode, :firstname, :lastname, :email, :tel, :city,:details, :message, :photo)');
        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel(),
            "city" => $pricing->getCity(),
            "details" => implode(',', $_POST["details"]),
            "message" => $pricing->getMessage(),
            "photo" => $this->saveUploadedFile($_FILES["photo"])
        ];

        if ($query->errorCode() !== '00000') {
            $errorInfo = $query->errorInfo();
            var_dump($errorInfo);
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
            $pricing= new Pricing($item["contactMode"], $item["firstname"], $item["lastname"], $item["email"], $item["tel"], $item["city"], $item["details"], $item["pricing"], $item["photo"]);
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
            $pricing = new Pricing($result["contactMode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["details"], $result["pricing"], $result["photo"]);
            $pricing->setId($result["id"]);
            return $pricing;
        }
        return null;
    }

    public function updatePricing(Pricing $pricing): void
    {
        $query = $this->db->prepare('UPDATE pricings SET contactMode = :contactMode, firstname = :firstname, lastname = :lastname, email = :email, tel = :tel, city = :city, details = :details, message = :message, photo = :photo WHERE id = :id');
        $parameters = [
            "contactMode" => $pricing->getContactMode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel(),
            "city" => $pricing->getCity(),
            "details" => implode(',', $_POST["details"]),
            "message" => $pricing->getMessage(),
            "photo" => $this->saveUploadedFile($_FILES["photo"])
        ];
        $query->execute($parameters);
    }

    public function deletePricing(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM pricings WHERE id = :id');
        $query->execute(["id" => $id]);
    }
}


