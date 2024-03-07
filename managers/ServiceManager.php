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
            $pm = new PictureManager();
            $pictures = $pm->findByRealId($item['id']);
            $service = new Service($item["title"], $item["intro"],$item["description"], $pictures);
            $service->setId($item["id"]);
            $services[] = $service;
        }

        return $services;
    }

    public function findById(int $id) : ? Service
    {
        $query = $this->db->prepare('SELECT * FROM services WHERE id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if($result)
        {
            $pm = new PictureManager();
            $pictures = $pm->findByServiceId($result['id']);
            $service = new Service($result["title"], $result["intro"], $result["description"], $pictures);
            $service->setId($result["id"]);
            return $service;
        }
        return null;
    }
}