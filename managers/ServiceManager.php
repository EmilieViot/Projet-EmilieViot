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
            $pictures = $pm->findByServiceId($item['id']);
            $service = new Service($item["title"], $item["intro"],$item["description"], $pictures);
            $service->setId($item["id"]);
            $services[] = $service;
//            dump($service);
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

    public function createService(Service $service): void
    {
        $query = $this->db->prepare('INSERT INTO services (id, title, intro, description) VALUES (NULL, :title, :intro, :description)');
        $parameters = [
            "title" => $service->getTitle(),
            "intro" => $service->getIntro(),
            "description" => $service->getDescription()
        ];
        $query->execute($parameters);

        $service->setId($this->db->lastInsertId());
    }
    public function deleteService(int $id): void
    {
        // Delete entries from the linking tables
        $query = $this->db->prepare('DELETE FROM services_pictures WHERE service_id = :id');
        $query->execute(['id' => $id]);

        $query = $this->db->prepare('DELETE FROM realisations_services WHERE service_id = :id');
        $query->execute(['id' => $id]);

        // Delete the entry from the main table
        $query = $this->db->prepare('DELETE FROM services WHERE id = :id');
        $query->execute(['id' => $id]);
    }

   /* public function updateService(Service $service): bool
    {
        $query = $this->db->prepare('UPDATE services SET title = :title, intro = :intro, description = :description WHERE id = :id');
        $parameters = [
            "id" => $service->getId(),
            "title" => $service->getTitle(),
            "intro" => $service->getIntro(),
            "description" => $service->getDescription()
        ];
        return $query->execute($parameters);
    }*/
}