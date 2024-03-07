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
}