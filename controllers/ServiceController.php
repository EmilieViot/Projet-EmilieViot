<?php

class ServiceController extends AbstractController
{


    public function services()
    {
        $sm = new ServiceManager();

        $services = $sm->findAll();

//        dump($services);

        $this->render("services/services.html.twig", [
            "services" => $services
        ]);
    }

    public function service(int $id)
    {
        $sm = new ServiceManager();

        $service = $sm->findById($id);

        $this->render("services/service.html.twig", [
            "service" => $service
        ]);
    }
}