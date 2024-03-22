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
}