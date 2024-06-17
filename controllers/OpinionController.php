<?php

class OpinionController extends AbstractController
{
    public function opinion(): void
    {
        $om = new OpinionManager();
        $opinions = $om->findAll();
        $rm = new RealisationManager();
        $realisations = $rm->findAll();
        $this->render("opinions/opinion.html.twig", ["opinions" => $opinions, "realisations" => $realisations]);
    }

    public function opinionRegister(): void
    {
        if (isset($_POST["username"]) && isset($_POST["content"]) && isset($_POST["notation"])) {
            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                $om = new OpinionManager();

                $username = htmlspecialchars($_POST['username']);
                $content = htmlspecialchars($_POST['content']);
                $notation = $_POST['notation'];

                if($_POST['realisation_id'] === "") {
                    $realisationId = null;
                }
                else {
                    $realisationId = intval($_POST['realisation_id']);
                }

                $opinion = new Opinion($username, $content, $notation, $realisationId);
                unset($_SESSION["error-message"]);
                $om->createOpinion($opinion);

                $_SESSION['new-opinion'] = true;

                $errorMessage = "Merci d'avoir pris le temps de laisser un avis. Nous restons à votre disposition pour toute demande.";
                $this->render("opinions/opinion.html.twig", ['message' => $errorMessage]);
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("opinion");
            };
        }
        else {
            $_SESSION["error-message"] = "Missing fields";
            $this->redirect('opinion');
        }
    }
}


