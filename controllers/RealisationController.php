<?php

class RealisationController extends AbstractController
{
    $rm = new RealisationManager();

    public function realisations()
    {
        $realisations = $sm->findAll();

        $this->render("realisations/realisations.html.twig", [
            "realisations" => $realisations
        ]);
    }

    public function realisation()
    {
        $realisation = $sm->findById();

        $this->render("realisations/realisation.html.twig", [
            "realisation" => $realisation
        ]);
    }