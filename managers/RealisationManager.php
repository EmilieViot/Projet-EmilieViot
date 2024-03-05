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
            $realisation = new Realisation($item["title"], $item["description"]);
            $realisation->setId($item["id"]);
            $realisations[] = $realisation;
        }

        return $realisations;
    }
}