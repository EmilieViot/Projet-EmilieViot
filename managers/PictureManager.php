<?php

class PictureManager extends AbstractManager
{

    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM pictures');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pictures = [];

        foreach ($result as $item) {
            $picture = new Picture($item["url"], $item["alt"]);
            $picture->setId($item["id"]);
            $pictures[] = $picture;
        }

        return $pictures;
    }


    public function findByServiceId(int $id): array
    {
        $query = $this->db->prepare('SELECT * FROM pictures join services_pictures ON services_pictures.picture_id=pictures.id WHERE services_pictures.service_id=:id');
        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pictures = [];


        foreach ($result as $item) {
            $picture = new Picture($item["url"], $item["alt"]);
            $picture->setId($item["id"]);
            $pictures[] = $picture;

        }
//        dump($pictures);
        return $pictures;
    }

    public function findByRealId(int $id): array
    {
        $query = $this->db->prepare('SELECT * FROM pictures join realisations_pictures ON realisations_pictures.picture_id=pictures.id WHERE realisations_pictures.realisation_id=:id');
        $parameters = [
            "id" => $id
        ];
        $query->execute($parameters);
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pictures = [];

        foreach ($result as $item) {
            $picture = new Picture($item["url"], $item["alt"]);
            $picture->setId($item["id"]);
            $pictures[] = $picture;
        }
        return $pictures;
    }
}
