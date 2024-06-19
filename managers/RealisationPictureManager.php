<?php

class RealisationPictureManager extends AbstractManager
{
    public function createOne($realisation, $picture): void
    {
        $query = $this->db->prepare('INSERT INTO realisations_pictures (realisation_id, picture_id) VALUES (:realisation_id, :picture_id)');
        $parameters = [
            'realisation_id' => $realisation->getId(),
            'picture_id' => $picture->getId(),
        ];
        $query->execute($parameters);
    }
    public function findOne($realisationId): void
    {
        $query = $this->db->prepare('INSERT INTO realisations_pictures (realisation_id, picture_id) VALUES (:realisation_id, :picture_id)');
        $parameters = [
            'realisation_id' => $realisation->getId(),
            'picture_id' => $picture->getId(),
        ];
        $query->execute($parameters);
    }
    public function findByRealisationId(int $realisationId): ?Realisation
    {
        $query = $this->db->prepare('
            SELECT r.id AS realisation_id, r.title, r.description, p.id AS picture_id, p.url, p.alt
            FROM realisations_pictures rp
            JOIN realisations r ON rp.realisation_id = r.id
            JOIN pictures p ON rp.picture_id = p.id
            WHERE r.id = :realisation_id
        ');
        $query->execute(['realisation_id' => $realisationId]);
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        /*var_dump($results);*/
        if ($results) {
            $pictures = [];
            foreach ($results as $item) {
                $picture = new Picture($item['url'], $item['alt']);
                $picture->setId($item['picture_id']);
                $pictures[] = $picture;
            }

            $realisation = new Realisation($results[0]['title'], $results[0]['description'], $pictures); // read the realisation informations just once
            $realisation->setId($results[0]['realisation_id']);
            return $realisation;
        }
        return null;
    }
}