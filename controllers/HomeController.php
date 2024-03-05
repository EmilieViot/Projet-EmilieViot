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
        foreach ($realisations as $realisation) {
            $realisationId = $realisation['id'];
            $pictures = $pm->finById($realisationId);
        }

        $services = $sm->findAll(); //on récupère un array
        foreach ($services as $service) {
            $serviceId = $service['id'];
            $pictures = $pm->finById($serviceId);
        }

        $opinions = $om->findAll();


        // Appeler la vue pour afficher les données et les images associées
        $this->render("home.html.twig", ["realisations" => $realisations, "pictures" => $pictures, "opinions" => $opinions, "services" => $services]);

    }
}