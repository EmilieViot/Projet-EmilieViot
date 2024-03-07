<?php

class Router
{
    public function handleRequest(array $get): void
    {
        $hc = new HomeController();
        $rc = new RealisationController();
        $sc = new ServiceController();
        $pc = new PricingController();
        $oc = new OpinionController();
        $mc = new MessageController();
        $ac = new AuthController();

/*HOME*/
        if (!isset($get["route"]))
        {
            $hc->home();
        }
        else if(isset($get["route"]) && $get["route"] === "home")
        {
            $hc->home();
        }
 /*REAL*/
        else if(isset($get["route"]) && $get["route"] === "realisations")
        {
            $rc->realisations();
        }
        else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "realisation")
        {
            $rc->realisation($get["id"]);
        }
/*SERVICES*/
        else if(isset($get["route"]) && $get["route"] === "services")
        {
            $sc->services();
        }
        else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "service")
        {
            $sc->service($get["id"]);
        }
/*OPINIONS*/
        else if(isset($get["route"]) && $get["route"] === "Opinion")
        {
            $oc->opinion();
        }
        else if(isset($get["route"]) && $get["route"] === "opinionRegister")
        {
            $oc->opinionRegister();
        }
        else if(isset($get["route"]) && $get["route"] === "login")
        {
            $ac->login();
        }
        else if(isset($get["route"]) && $get["route"] === "admin")
        {
            $oc->opinion();
        }
}
    private OpinionController $oc;
}