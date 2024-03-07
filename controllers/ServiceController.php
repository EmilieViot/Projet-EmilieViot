<?php

class ServiceController extends AbstractController
{
    $sm = new ServiceManager();

    public function services()
    {
        $services = $sm->findAll();

        $this->render("services/services.html.twig", [
            "services" => $services
        ]);
    }

    public function service()
    {
        $services = $sm->findById();

        $this->render("services/service.html.twig", [
            "service" => $service
        ]);
    }
}