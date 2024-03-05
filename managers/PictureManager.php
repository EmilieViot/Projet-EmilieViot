<?php

class PictureManager extends AbstractManager
{

    public function findAll() : array
    {
        $query = $this->db->prepare('SELECT * FROM pictures');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $pictures = [];

        foreach($result as $item)
        {
            $picture = new Picture($item["url"], $item["alt"]);
            $picture->setId($item["id"]);
            $pictures[] = $picture;
        }

        return $pictures;
    }


public function findById(int $id) : array
    {
        $query = $this->db->prepare('SELECT * FROM pictures WHERE id=:id');

        $parameters = [
            "id" => $id
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);
        $pictures = [];

        foreach($result as $item)
        {
            $picture = new Picture($item["url"], $item["alt"]);
            $picture->setId($item["id"]);
            $pictures[] = $picture;
        }
        dump($pictures);

        return $pictures;
    }
}