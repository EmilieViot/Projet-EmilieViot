<?php

class PricingController extends AbstractController
{
    public function pricing(): void
    {
        $dm = new DetailManager();
        $details = $dm->findAll();
        $this->render("pricing/pricing.html.twig", ['details' => $details]);
    }

    public function pricingRegister() : void
    {
        if (isset($_POST["contactMode"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["email"])) {

            $tokenManager = new CSRFTokenManager();
            if(isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])){
                $dm = new DetailManager();
                $pm = new PricingManager();

                $contactMode = htmlspecialchars($_POST["contactMode"]);
                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $tel = htmlspecialchars($_POST["tel"]);
                $city = htmlspecialchars($_POST["city"]);
                $message = htmlspecialchars($_POST["message"]);

                $pricing = new Pricing($contactMode, $firstname, $lastname, $email, $tel, $city, $message);
                unset($_SESSION["error-message"]);
                $pm->createPricing($pricing);

                $details = $_POST["details"];
                $details_array = [];
                foreach ($details as $detailData) {
                    $detail = $dm->findByTitle($detailData);
                    $details_array[] = $detail;
                    dump($details_array);
                }

                $pdm = new PricingDetailManager();

                foreach ($details_array as $detail) {
                    $pdm->createOne($pricing, $detail);
                }
                $this->redirect("index.php?route=pricingConfirmation");
            }
            else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("index.php?route=pricing");
            }
        } else {
            $_SESSION["error-message"] = "Missing fields";
            $this->redirect("index.php?route=pricing");
        }
    }

    public function pricingConfirmation(): void
    {
        $this->render("contact/pricingConfirmation.html.twig", []);
    }
}