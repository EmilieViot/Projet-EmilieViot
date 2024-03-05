<?php

class OpinionManager extends AbstractManager
{

    public function findAll() : array
    {
        $rm = new RealisationManager();

        $query = $this->db->prepare('SELECT * FROM opinions');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];

        foreach($result as $item)
        {
            $realisation = $rm->findOne($item['realisation_id']);
            $opinion = new Opinion($item["username"], $item["content"], $realisation);
            $opinion->setId($item["id"]);
            $opinions[] = $opinion;
        }

        return $opinions;
    }
}