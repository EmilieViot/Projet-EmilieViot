<?php

class OpinionManager extends AbstractManager
{
    public function findAll(): array
    {
        $query = $this->db->prepare('SELECT * FROM opinions');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];

        foreach ($result as $item) {
            $realisationId = null;

            if (!empty($item['realisation_id'])) {
                $realisationId = $item['realisation_id'];
            }
            $opinion = new Opinion($item["username"], $item["content"], $item["notation"], $realisationId);
            $opinion->setId($item["id"]);
            $opinions[] = $opinion;
        }
        return $opinions;
    }

    public function getOpinionById(int $id): ?Opinion
    {
        $query = $this->db->prepare('SELECT * FROM opinions WHERE id = :id');
        $query->execute(["id" => $id]);

        $result = $query->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            $realisationId = null;

            if (!empty($result['realisation_id'])) {
                $realisationId = $result['realisation_id'];
            }
            $opinion = new Opinion($item["username"], $item["content"], $item["notation"], $realisationId);
            $opinion->setId($item["id"]);
            return $opinion;
        }
        return null;
    }

    public function createOpinion(Opinion $opinion): void
    {
        if ($opinion->getRealisationId() === null) {
            $query = $this->db->prepare('INSERT INTO opinions (id, username, content, notation, realisation_id) VALUES (NULL, :username, :content, :notation, NULL)');
            $parameters = [
                "username" => $opinion->getUsername(),
                "content" => $opinion->getContent(),
                "notation" => $opinion->getNotation(),
            ];
        } else {
            $query = $this->db->prepare('INSERT INTO opinions (id, username, content, notation, realisation_id) VALUES (NULL, :username, :content, :notation, :realisationId)');
            $parameters = [
                "username" => $opinion->getUsername(),
                "content" => $opinion->getContent(),
                "notation" => $opinion->getNotation(),
                "realisationId" => $opinion->getRealisationId(),
            ];
        }
        $query->execute($parameters);
        $opinion->setId($this->db->lastInsertId());
    }
}