<?php

class HomeController extends AbstractController
{
    public function home()
    {
        $rm = new RealisationManager();
        $om = new OpinionManager();
        $sm = new ServiceManager();
        $realisations = $rm->findAll(); //on récupère un array
        $services = $sm->findAll(); //on récupère un array
        $opinions = $om->findAll();
        $this->render("home.html.twig", ["realisations" => $realisations, "opinions" => $opinions,"services" => $services]);
    }
}