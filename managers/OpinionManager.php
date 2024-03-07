<?php

class OpinionManager extends AbstractManager
{

    public function findAll() : array
    {
        $realisation = new Realisation();

        $query = $this->db->prepare('SELECT * FROM opinions');
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        $opinions = [];

        foreach($result as $item)
        {
            $realisation = null;

            if (!empty($item['realisation_id'])) {
                $realisation = $rm->findById($item['realisation_id']);
            }

            $opinion = new Opinion($item["username"], $item["content"], $item["notation"], $realisation);
            $opinion->setId($item["id"]);
            $opinions[] = $opinion;
        }

        return $opinions;
    }

    public function createOpinion(Opinion $opinion): void
    {
        $query = $this->db->prepare('INSERT INTO opinions (id, username, content, notation) VALUES (NULL, :firstname, :lastname, :city, :email, :content)');
        $parameters = [
            "firstname" => $opinion->getFirstname(),
            "lastname" => $opinion->getLastname(),
            "city" => $opinion->getCity(),
            "email" => $opinion->getEmail(),
            "content" => $opinion->getContent()
        ];
        $query->execute($parameters);
        $opinion->setId($this->db->lastInsertId());
    }
}