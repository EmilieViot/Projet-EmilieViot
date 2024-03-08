<?php

class MessageController extends AbstractController
{
    public function contact(): void
    {
        $this->render("contact/contact.html.twig", []);
    }

    public function messageRegister() : voidS
    {
        if(isset($_POST["csrf-token"]) && isset($_POST["firstname"]) && isset($_POST["lastname"]) && isset($_POST["city"]) && isset($_POST["email"]) && isset($_POST["content"]))
        {
            $tokenManager = new CSRFTokenManager();

            if($tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                $mm = new MessageManager();

                $message= new Message($_POST["firstname"], $_POST["lastname"], $_POST["city"], $_POST["email"], $_POST["content"]);
                $mm->createMessage($message);

                $this->redirect('messageConfirmation');
            }
        }
        $this->redirect("contact");
    }

    public function messageConfirmation(): void
    {
        $this->render("contact/messageConfirmation.html.twig", []);
    }
}