<?php

class ServiceController extends AbstractController
{


    public function services()
    {
        $sm = new ServiceManager();

        $services = $sm->findAll();

        $this->render("services/services.html.twig", [
            "services" => $services
        ]);
    }

    public function service()
    {
        $sm = new ServiceManager();

        $service = $sm->findById();

        $this->render("services/service.html.twig", [
            "service" => $service
        ]);
    }
}