<?php

class ServicePictureManager extends AbstractManager
{
    public function createOne($service, $picture): void
    {
        $query = $this->db->prepare('INSERT INTO services_pictures (service_id, picture_id) VALUES (:service_id, :picture_id)');
        $parameters = [
            'service_id' => $service->getId(),
            'picture_id' => $picture->getId(),
        ];
        $query->execute($parameters);
    }
}