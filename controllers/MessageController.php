<?php

class MessageController extends AbstractController
{
    public function contact(): void
    {
        $this->render("contact/contact.html.twig", []);
    }

    public function messageRegister(): void
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

                $response = [' ' => 'OK', 'message' => "Merci $firstname $lastname pour votre demande. Nous revenons vers vous dans les plus brefs délais."
                ];
            } else {
                http_response_code(405);
                $response = [' ' => 'error', 'message' => 'Méthode non autorisée'];
            }
        } else {
            $response = [' ' => 'error', 'message' => 'Merci de compléter les champs obligatoires'];
        }

        $this->renderJson($response);
    }


    public function messageConfirmation(): void
    {
        $this->render("contact/messageConfirmation.html.twig", []);
    }
}