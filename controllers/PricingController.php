<?php

class PricingController extends AbstractController
{
    public function pricing(): void
    {
        $dm = new DetailManager();
        $details = $dm->findAll();
        $this->render("pricing/pricing.html.twig", ['details' => $details]);
    }

    public function pricingRegister(): void
    {
        if (isset($_POST["contact_mode"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && (isset($_POST["email"]) || isset($_POST["tel"]))) {
            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                $dm = new DetailManager();
                $pm = new PricingManager();

                $contact_mode = htmlspecialchars($_POST["contact_mode"]);
                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $tel = htmlspecialchars($_POST["tel"]);
                $city = htmlspecialchars($_POST["city"]);
                $message = htmlspecialchars($_POST["message"]);

                $photo_path = null;

                // Vérifier si un fichier a été téléchargé
                if (isset($_FILES['picture'])) {
                    $uploader = new Uploader();
                    $picture = $uploader->upload($_FILES, "picture");
                    if ($picture !== null) {
                        $photo_path = $picture->getUrl();
                    } else {
                        $photo_path = null;
                    }
                }

                $details = $_POST["details"];
                $details_array = [];
                foreach ($details as $detailData) {
                    $detail = $dm->findByTitle($detailData);
                    $details_array[] = $detail;
                }

                $pricing = new Pricing($contact_mode, $firstname, $lastname, $email, $tel, $city, $message, $details_array, $photo_path);
                unset($_SESSION["error-message"]);
                $pm->createPricing($pricing);

                $pdm = new PricingDetailManager();

                foreach ($details_array as $detail) {
                    $pdm->createOne($pricing, $detail);
                }

                $successMessage = "Votre demande a bien été transmise. Nous revenons vers vous dans les plus brefs délais.";
                $this->render("pricing/pricing.html.twig", ['message' => $successMessage]);

            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("pricing");
            }
        } else {
            $_SESSION["error-message"] = "Merci de compléter tous les champs requis";
            $this->redirect('pricing');
        }
    }
}
