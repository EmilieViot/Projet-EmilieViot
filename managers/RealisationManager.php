<?php

class RealisationManager extends AbstractManager
{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM realisations');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $realisations = [];

        foreach($result as $item)
        {
            $pm = new PictureManager();
            $pictures = $pm->findByRealId($item['id']);
            $realisation = new Realisation($item["title"], $item["description"], $pictures);
            $realisation->setId($item["id"]);
            $realisations[] = $realisation;
        }
        return $realisations;
    }

    public function findLatest() : array
    {
        $query = $this->db->prepare('SELECT * FROM realisations LIMIT 4');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $realisations = [];

        foreach($result as $item)
        {
            $pm = new PictureManager();
            $pictures = $pm->findByRealId($item['id']);
            $realisation = new Realisation($item["title"], $item["description"], $pictures);
            $realisation->setId($item["id"]);
            $realisations[] = $realisation;
        }
        return $realisations;
    }

    public function findById(int $id) : ? Realisation
    {
        $query = $this->db->prepare('SELECT * FROM realisations WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $pm = new PictureManager();
            $pictures = $pm->findByRealId($result['id']);
            $realisation = new Realisation($result["title"], $result["description"], $pictures);
            $realisation->setId($result["id"]);
            return $realisation;
        }
        return null;
    }

    public function createReal(Realisation $realisation): void
    {
        $query = $this->db->prepare('INSERT INTO realisations (id, title, description) VALUES (NULL, :title, :description)');
        $parameters = [
            "title" => $realisation->getTitle(),
            "description" => $realisation->getDescription()
        ];
        $query->execute($parameters);

        $realisation->setId($this->db->lastInsertId());
    }

   /* public function updateReal(Realisation $realisation): bool
    {
        $query = $this->db->prepare('UPDATE realisations SET title = :title, description = :description WHERE id = :id');
        $parameters = [
            "id" => $realisation->getId(),
            "title" => $realisation->getTitle(),
            "description" => $realisation->getDescription()
        ];
        return $query->execute($parameters);
    }*/

    public function deleteReal(int $id): void
    {
        // Delete entries from the linking tables
        $query = $this->db->prepare('DELETE FROM realisations_pictures WHERE realisation_id = :id');
        $query->execute(['id' => $id]);

        $query = $this->db->prepare('DELETE FROM realisations_services WHERE realisation_id = :id');
        $query->execute(['id' => $id]);

        // Delete the entry from the main table
        $query = $this->db->prepare('DELETE FROM realisations WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}