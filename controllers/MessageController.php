<?php

class MessageController extends AbstractController
{
    public function contact(): void
    {
        $this->render("contact/contact.html.twig", []);
    }

    public function messageRegister() : void
    {
        if (isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["city"]) && isset($_POST["email"]) && isset($_POST["content"])) {
            $tokenManager = new CSRFTokenManager();

            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {
                $mm = new MessageManager();

                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $city = htmlspecialchars($_POST["city"]);
                $email = htmlspecialchars($_POST["email"]);
                $content = htmlspecialchars($_POST["content"]);

                $message = new Message($firstname, $lastname, $city, $email, $content);
                $mm->createMessage($message);

                $message = "Votre demande a bien été transmise. Nous revenons vers vous dans les plus brefs délais.";
                $this->render("contact/contact.html.twig", ['message' => $message]);
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("contact");
            }
        }
        else {
            $_SESSION["error-message"] = "Merci de compléter les champs obligatoires";
            $this->redirect('contact');
        }
    }

    public function messageConfirmation(): void
    {
        $this->render("contact/messageConfirmation.html.twig", []);
    }
}