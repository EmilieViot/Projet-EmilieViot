<?php

class HomeController extends AbstractController
{
    public function home()
    {
        $rm = new RealisationManager();
        $pm = new PictureManager();
        $om = new OpinionManager();
        $sm = new ServiceManager();

        $realisations = $rm->findAll(); //on récupère un array

        $services = $sm->findAll(); //on récupère un array

        $opinions = $om->findAll();


        // Appeler la vue pour afficher les données et les images associées
        $this->render("home.html.twig", [
            "realisations" => $realisations,
            "opinions" => $opinions,
            "services" => $services
        ]);
    }

}