<?php

class DefaultController extends AbstractController
{
    public function home()
    {
        $rm = new RealisationManager();
        $om = new OpinionManager();
        $sm = new ServiceManager();

        $realisations = $rm->findAll();
        $key = array_rand($realisations, 1);
        $realisation = [];
        $realisation["realisation"] = $realisations[$key];

        $services = $sm->findAll();
        $keys = array_rand($services, 1);
        $service = [];
        $service["service"] = $services[$key];
        }

        $this->render("home/home.html.twig", [
            "realisations" => $realisation,
            "services" => $service,
        ]);
    }
}