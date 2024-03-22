<?php

class RealisationPicture
{
    private ?int $id = null;

    public function __construct(private Realisation $realisation, private Picture $picture)
    {

    }

    public function getRealisation(): Realisation
    {
        return $this->realisation;
    }
    public function setRealisation(Realisation $realisation): void
    {
        $this->realisation = $realisation;
    }
    public function getPicture(): Picture
    {
        return $this->picture;
    }
    public function setPicture(Picture $picture): void
    {
        $this->picture = $picture;
    }
}