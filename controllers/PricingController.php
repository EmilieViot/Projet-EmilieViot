<?php

class PricingController extends AbstractController
{
    public function pricing(): void
    {
        $this->render("pricing/pricing.html.twig", []);
    }

    public function pricingRegister() : void
    {
        if(isset($_POST["csrf-token"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["city"]) && isset($_POST["email"]) && isset($_POST["content"]))
        {
            $tokenManager = new CSRFTokenManager();

            if($tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                $pm = new PricingManager();

                $pricing= new Pricing($_POST["contactMode"], $_POST["firstname"], $_POST["lastname"], $_POST["email"], $_POST["tel"], $_POST["city"], $_POST["details"], $_POST["message"], $_POST["photoPath"]);
                $pm->createPricing($pricing);

                $this->redirect('pricingConfirmation');
            }
        }
        $this->redirect("contact");
    }

    public function pricingConfirmation(): void
    {
        $this->render("contact/pricingConfirmation.html.twig", []);
    }
}