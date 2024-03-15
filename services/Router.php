<?php

class Router extends AbstractController
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
        $PC = new PageController();


        /*HOME*/
        if (!isset($get["route"])) {
            $hc->home();
        } else if (isset($get["route"]) && $get["route"] === "home") {
            $hc->home();
        }

        /*REAL*/
        else if (isset($get["route"]) && $get["route"] === "realisations") {
            $rc->realisations();
        } else if (isset($get["route"]) && isset($get["id"]) && $get["route"] === "realisation") {
            $rc->realisation($get["id"]);
        }

        /*SERVICES*/
        else if (isset($get["route"]) && $get["route"] === "services") {
            $sc->services();
        } else if (isset($get["route"]) && isset($get["id"]) && $get["route"] === "service") {
            $sc->service($get["id"]);
        }

        /*OPINIONS*/
        else if(isset($get["route"]) && $get["route"] === "opinions")
        {
            $oc->opinion();
        }
        else if(isset($get["route"]) && $get["route"] === "opinionRegister")
        {
            $oc->opinionRegister();
        }
        else if(isset($get["route"]) && $get["route"] === "opinionConfirmation")
        {
            $oc->opinionConfirmation();
        }

        /*CONTACT*/
        else if(isset($get["route"]) && $get["route"] === "contact")
        {
            $mc->contact();
        }
        else if(isset($get["route"]) && $get["route"] === "messageRegister")
        {
            $mc->messageRegister();
        }
        else if(isset($get["route"]) && $get["route"] === "messageConfirmation")
        {
            $mc->messageConfirmation();
        }

        /*PRICING*/
        else if(isset($get["route"]) && $get["route"] === "pricing")
        {
            $pc->pricing();
        }
        else if(isset($get["route"]) && $get["route"] === "pricingRegister")
        {
            $pc->pricingRegister();
        }
        else if(isset($get["route"]) && $get["route"] === "pricingConfirmation")
        {
            $pc->pricingConfirmation();
        }

        /*ADMIN*/
        else if(isset($get["route"]) && $get["route"] === "login")
        {
            $ac->login();
        }
        else if(isset($get["route"]) && $get["route"] === "loginCheck")
        {
            $ac->loginCheck();
        }

        else if(isset($get["route"]) && $get["route"] === "admin")
        {
            $PC->admin();
        }

//        /*MENTIONS LEGALES*/
        else if(isset($get["route"]) && $get["route"] === "legal")
        {
            $PC->legal();
        }
    }
}