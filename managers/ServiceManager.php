<?php

class ServiceManager extends AbstractManager
{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM services');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $services = [];

        foreach($result as $item)
        {
            $service = new Service($item["title"], $item["intro"],$item["description"]);
            $service->setId($item["id"]);
            $services[] = $service;
        }

        return $services;
    }
}