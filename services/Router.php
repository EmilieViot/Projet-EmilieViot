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
        $adc = new AdminController();
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
            $rc->realisation((int)$get["id"]);
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

    /*ADMIN*/
        /*login */
        else if(isset($get["route"]) && $get["route"] === "login")
        {
            $ac->login();
        }
        else if(isset($get["route"]) && $get["route"] === "logout")
        {
            $ac->logout();
        }
        else if(isset($get["route"]) && $get["route"] === "loginCheck")
        {
            $ac->loginCheck();
        }
        /*page admin*/
        else if(isset($get["route"]) && $get["route"] === "admin")
        {
            $adc->admin();
        }

            /*messages*/
            else if(isset($get["route"]) && $get["route"] === "list-messages")
            {
                $adc->messagesList();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "show-message")
            {
                $adc->showMessage();
            }
            /*opinions*/
            else if(isset($get["route"]) && $get["route"] === "list-opinions")
            {
                $adc->opinionsList();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "show-opinion")
            {
                $adc->showOpinion();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "edit-opinion")
            {
                $adc->editOpinion();
            }
            else if(isset($get["route"]) && $get["route"] === "check-opinion-edition")
            {
                $adc->checkEditOpinion();
            }
            /*pricings*/
            else if(isset($get["route"]) && $get["route"] === "list-pricings")
            {
                $adc->pricingsList();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "show-pricing")
            {
                $adc->showPricing();
            }
            /*reals*/
            else if(isset($get["route"]) && $get["route"] === "list-reals")
            {
                $adc->realsList();
            }
            else if(isset($get["route"]) && $get["route"] === "create-real")
            {
                $adc->createReal();
            }
            else if(isset($get["route"]) && $get["route"] === "check-real-creation")
            {
                $adc->checkRealCreation();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "show-real")
            {
                $adc->showReal();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "edit-real")
            {
                $adc->editReal();
            }
            else if(isset($get["route"]) && $get["route"] === "check-real-edition")
            {
                $adc->checkEditReal();
            }
            /*services*/
            else if(isset($get["route"]) && $get["route"] === "list-services")
            {
                $adc->servicesList();
            }
            else if(isset($get["route"]) && $get["route"] === "create-service")
            {
                $adc->createService();
            }
            else if(isset($get["route"]) && $get["route"] === "check-service-creation")
            {
                $adc->checkServiceCreation();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "show-service")
            {
                $adc->showService();
            }
            else if(isset($get["route"]) && isset($get["id"]) && $get["route"] === "edit-service")
            {
                $adc->editService();
            }
            else if(isset($get["route"]) && $get["route"] === "check-service-edition")
            {
                $adc->checkEditService();
            }


    /*MENTIONS LEGALES*/
        else if(isset($get["route"]) && $get["route"] === "legal")
        {
            $PC->legal();
        }

    /*ERROR 404*/
        else
        {
            $PC -> error404();
        }
    }
}