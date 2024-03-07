<?php

class MessageController extends AbstractController
{
    public function contact(): void
    {
        $this->render("contact", []);
    }

    public function messageRegister(): void
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Récupération des données du formulaire


            $mm = new MessageManager();
            $message = $mm->createMessage();

        }
    }
}