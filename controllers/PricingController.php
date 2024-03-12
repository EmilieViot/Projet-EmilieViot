<?php

class PricingController extends AbstractController
{
    public function pricing(): void
    {
        $this->render("pricing/pricing.html.twig", []);
    }

    public function pricingRegister() : void
    {
        if(isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["city"]) && isset($_POST["email"]) && isset($_POST["details"])) {
            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                $pm = new PricingManager();

                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $tel = htmlspecialchars($_POST["tel"]);
                $city = htmlspecialchars($_POST["city"]);
                $message = htmlspecialchars($_POST["message"]);

                $pricing = new Pricing($_POST["contactMode"], $firstname, $lastname, $email, $tel, $city, $_POST["details"], $message, $_FILES["photo"]);
                $_SESSION["user"] = $user->getId();

                unset($_SESSION["error-message"]);

                dump($pricing);

                $pm->createPricing($pricing);

                $this->redirect('pricingConfirmation');
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("index.php?route=pricing");
            }
        }
        else
        {
            $_SESSION["error-message"] = "Missing fields";
            $this->redirect("pricing");
        }
    }

    public function pricingConfirmation(): void
    {
        $this->render("contact/pricingConfirmation.html.twig", []);
    }
}