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
                var_dump($firstname, $lastname, $city, $email, $content);

                $message = new Message($firstname, $lastname, $city, $email, $content);
                var_dump($message);

                $mm->createMessage($message);

                $response = [
                    'status' => 'OK',
                    'message' => "Merci $firstname $lastname pour votre demande. Nous revenons vers vous dans les plus brefs délais."
                ];
                echo json_encode($response);
            } else {
                http_response_code(405);
                echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée']);
            }
        } else {
            $response = [
                'status' => 'pas OK',
                'message' => "Merci de compléter les champs obligatoires"
            ];
            $this->redirect('contact');

            var_dump($response);
        }
    }



    public function messageConfirmation(): void
    {
        $this->render("contact/messageConfirmation.html.twig", []);
    }
}