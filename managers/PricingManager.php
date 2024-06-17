<?php

class PricingManager extends AbstractManager
{
    // Finds and returns a Pricing object by its ID
    public function findOne(int $id) : ?Pricing
    {
        // Prepare a SQL query to select a pricing by its ID
        $query = $this->db->prepare('SELECT * FROM pricings WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        // Execute the query with the provided parameters
        $query->execute($parameters);
        // Fetch the result as an associative array
        $result = $query->fetch(PDO::FETCH_ASSOC);

        // If a result is found, create a Pricing object
        if($result)
        {
            // Create a DetailManager instance to fetch associated details
            $dm = new DetailManager();
            // Fetch details associated with the pricing
            $details = $dm->findByPricing((int)$result['id']);
            // Create a Pricing object with fetched data
            $pricing = new Pricing($result["contact_mode"], $result["firstname"], $result["lastname"], $result["email"], $result["tel"], $result["city"], $result["message"], $details, $result["photo_path"]);
            // Set the ID of the Pricing object
            $pricing->setId($result["id"]);
            // Return the Pricing object
            return $pricing;
        }
        // Return null if no result is found
        return null;
    }

    // Creates a new Pricing entry in the database
    public function createPricing(Pricing $pricing): void
    {
        // Prepare a SQL query to insert a new pricing entry
        $query = $this->db->prepare('INSERT INTO pricings (id, contact_mode, firstname, lastname, email, tel, city, message, photo_path) VALUES (NULL, :contact_mode, :firstname, :lastname, :email, :tel, :city, :message, :photo_path)');
        $parameters = [
            // Bind parameters from the Pricing object to the query
            "contact_mode" => $pricing->getcontact_mode(),
            "firstname" => $pricing->getFirstname(),
            "lastname" => $pricing->getLastname(),
            "email" => $pricing->getEmail(),
            "tel" => $pricing->getTel(),
            "city" => $pricing->getCity(),
            "message" => $pricing->getMessage(),
            "photo_path" => $pricing->getphoto_path()
        ];

        // Execute the query with the provided parameters
        $query->execute($parameters);

        // Set the ID of the Pricing object to the last inserted ID in the database
        $pricing->setId($this->db->lastInsertId());
    }

    // Fetches all Pricing entries from the database
    public function findAll(): array
    {
        // Prepare a SQL query to select all pricings
        $query = $this->db->prepare('SELECT * FROM pricings');
        // Execute the query
        $query->execute();
        // Fetch all results as an associative array
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pricings = [];

        // Loop through each result and create Pricing objects
        foreach ($result as $item) {
            // Create a DetailManager instance to fetch associated details
            $dm = new DetailManager();
            // Fetch details associated with each pricing
            $details = $dm->findByPricing($item['id']);
            // Create a Pricing object with fetched data
            $pricing = new Pricing($item["contact_mode"], $item["firstname"], $item["lastname"], $item["email"], $item["tel"], $item["city"], $item["message"], $details, $item["photo_path"]);
            $pricing->setId($item["id"]);
            // Add the Pricing object to the array
            $pricings[] = $pricing;
        }
        // Return the array of Pricing objects
        return $pricings;
    }


    // Deletes a Pricing entry from the database by its ID
    public function deletePricing(int $id): void
    {
        // Delete entries from the linking table
        $query = $this->db->prepare('DELETE FROM pricing_detail WHERE pricing_id = :id');
        $query->execute(['id' => $id]);

        // Delete the entry from the main table
        $query = $this->db->prepare('DELETE FROM pricings WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
