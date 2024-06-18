<?php

require 'vendor/autoload.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

abstract class AbstractController
{
    private \Twig\Environment $twig;
    public function __construct()
    {
        $loader = new \Twig\Loader\FilesystemLoader('templates');
        $twig = new \Twig\Environment($loader,[
            'debug' => true,
        ]);

        $twig->addExtension(new \Twig\Extension\DebugExtension());
        $twig->addGlobal('sessionToken', $_SESSION["csrf-token"]);
        /*$twig->addGlobal('errorMessage', $_SESSION["error-message"]);*/

        $twig->addGlobal('url', $_SERVER['REQUEST_URI']);
        $uri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', $uri);
        $route = end($segments);
        $twig->addGlobal('current_route', $route);

        $this->twig = $twig;
    }

    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data);
    }
    protected function redirect(string $route) : void
    {
        header("Location: index.php?route=$route");
    }

    protected function renderJson(array $data) : void
    {
        echo json_encode($data);
    }

    protected function sendMessage() : bool
    {
    // Create a new PHPMailer instance
        $mail = new PHPMailer(true);
        try {
            // Set up SMTP debugging
            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            // Set up SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["SMTP_MAIL"];
            $mail->Password   = $_ENV["SMTP_PASSWORD"];
            // Set character encoding to UTF-8
            $mail->CharSet    = "utf-8";
            // Set the sender
            $mail->setFrom($_ENV["SMTP_MAIL"], 'Site AVEN Plaquiste');
            // Add recipient
            $mail->addAddress($_ENV["SMTP_MAIL"], 'Admin');
            // Enable HTML in the email body
            $mail->isHTML(true);
            // Set email subject and body
            $mail->Subject = "Nouvelle notification - AVEN Plaquiste";
            $mail->Body    = "Il y a du nouveau sur le site d'AVEN Plaquiste - rendez-vous vite en admin !  ";
            // Send the email
            $mail->send();
            return true;
        } catch (Exception) {
            return false;
        }
    }
}