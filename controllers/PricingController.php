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
        if (isset($_POST["contactMode"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && (isset($_POST["email"]) || isset($_POST["tel"]))){
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

                $uploader = new Uploader();
                $picture= $uploader->upload($_FILES, "picture");
                $photoPath = $picture->getUrl();

                $details = $_POST["details"];
                $details_array = [];
                foreach ($details as $detailData) {
                    $detail = $dm->findByTitle($detailData);
                    $details_array[] = $detail;
                }

                $pricing = new Pricing($contactMode, $firstname, $lastname, $email, $tel, $city, $message, $details_array, $photoPath);
                unset($_SESSION["error-message"]);
                $pm->createPricing($pricing);


                $pdm = new PricingDetailManager();

                foreach ($details_array as $detail) {
                    $pdm->createOne($pricing, $detail);
                }
                $errorMessage = "Votre demande a bien été transmise. Nous revenons vers vous dans les plus brefs délais.";
                $this->render("pricing/pricing.html.twig", ['message' => $errorMessage]);
            }
            else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("pricing");
            }
        } else {
            $_SESSION["error-message"] = "Merci de compléter tous les champs requis";
            $this->redirect('pricing');
        }
    }
}