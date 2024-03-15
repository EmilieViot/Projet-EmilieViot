<?php

class DetailManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM details');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $details = [];

        foreach ($result as $item) {
            $detail = new Detail($item["title"]);
            $detail->setId($item["id"]);
            $details[] = $detail;
        }
        return $details;
    }

    public function findByTitle(string $title): ?Detail
    {
        $query = $this->db->prepare('SELECT * FROM details WHERE title = :title');
        $parameters = [
            "title" => $title
        ];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result)
        {
            $detail = new Detail($result["title"]);
            $detail->setId($result["id"]);

            return $detail;
        }
        return null;
    }

}