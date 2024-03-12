<?php

class OpinionController extends AbstractController
{
    public function opinion(): void
    {
        $om = new OpinionManager();
        $opinions = $om->findAll();
        $this->render("opinions/opinion.html.twig", ["opinions" => $opinions]);
    }

    public function opinionRegister(): void
    {
        if (isset($_POST["csrf-token"]) && isset($_POST["username"]) && isset($_POST["content"]) && isset($_POST["notation"]))
        {
            $tokenManager = new CSRFTokenManager();

            if ($tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                $om = new OpinionManager();

                $username = $_POST['username'];
                $content = $_POST['content'];
                $notation = $_POST['notation'];
                $realisationId = $_POST['realisation_id'];

                $opinion = new Opinion($username, $content, $notation, $realisationId);
                $om->createOpinion($opinion);

                $this->redirect('opinionConfirmation');
            }
            $this->redirect("opinions");
        }
    }

    public function opinionConfirmation(): void
    {
        $this->render("opinions/opinionConfirmation.html.twig", []);
    }
}


