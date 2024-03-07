<?php

class OpinionController extends AbstractController
{
    public function opinion(): void
    {
        $this->render("opinion", []);
    }

    public function opinionProcessing(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire


            $mm = new OpinionManager();
            $opinion = $mm->createOpinion();

        }
    }
}

