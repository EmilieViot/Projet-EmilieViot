<?php

class RealisationController extends AbstractController
{


    public function realisations()
    {
        $rm = new RealisationManager();
        $realisations = $rm->findLatest();
        /*dump($realisations);*/

        $this->render("realisations/realisations.html.twig", ["realisations" => $realisations]);
    }

    public function realisation(int $id)
    {
        $rm = new RealisationManager();
        $realisation = $rm->findById($id);

        $this->render("realisations/realisation.html.twig", ["realisation" => $realisation]);
    }
}