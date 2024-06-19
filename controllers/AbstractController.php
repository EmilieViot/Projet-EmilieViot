<?php

// Include Composer's autoloader for dependency management
require 'vendor/autoload.php';

// Import PHPMailer classes for sending emails
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

// Define an abstract controller class
abstract class AbstractController
{
    // Declare a Twig environment variable
    private \Twig\Environment $twig;

    // Constructor to initialize the Twig environment
    public function __construct()
    {
        // Load templates from the 'templates' directory
        $loader = new \Twig\Loader\FilesystemLoader('templates');

        // Create a new Twig environment with debugging enabled
        $twig = new \Twig\Environment($loader, [
            'debug' => true,
        ]);

        // Add debugging extension to Twig
        $twig->addExtension(new \Twig\Extension\DebugExtension());

        // Add global variables to Twig
        $twig->addGlobal('sessionToken', $_SESSION["csrf-token"]);
        // $twig->addGlobal('errorMessage', $_SESSION["error-message"]);

        // Add the current URL to Twig globals
        $twig->addGlobal('url', $_SERVER['REQUEST_URI']);

        // Extract the current route from the URL
        $uri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', $uri);
        $route = end($segments);
        $twig->addGlobal('current_route', $route);

        // Assign the configured Twig environment to the class property
        $this->twig = $twig;
    }

    // Render a Twig template with provided data
    protected function render(string $template, array $data) : void
    {
        echo $this->twig->render($template, $data);
    }

    // Redirect to a specified route
    protected function redirect(string $route) : void
    {
        header("Location: index.php?route=$route");
    }

    // Render a JSON response with provided data
    protected function renderJson(array $data) : void
    {
        echo json_encode($data);
    }
    // Send an email using PHPMailer
    protected function newMessage() : bool
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Disable SMTP debugging
            $mail->SMTPDebug = SMTP::DEBUG_OFF;

            // Set up SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["SMTP_MAIL"];
            $mail->Password   = $_ENV["SMTP_PASSWORD"];

            // Set character encoding to UTF-8
            $mail->CharSet    = "utf-8";

            // Set the sender's email address
            $mail->setFrom($_ENV["SMTP_MAIL"], 'Site AVEN Plaquiste');

            // Add a recipient
            $mail->addAddress($_ENV["SMTP_MAIL"], 'Admin');

            // Enable HTML in the email body
            $mail->isHTML(true);

            // Set email subject and body
            $mail->Subject = "Nouvelle demande de contact - AVEN Plaquiste";
            $mail->Body    = "Vous avez une nouvelle demande de contact sur le site d'AVEN Plaquiste. Rendez-vous vite en admin dans la rubrique 'MESSAGES' !";

            // Send the email
            $mail->send();
            return true;
        } catch (Exception) {
            // Return false if there is an exception
            return false;
        }
    }
    protected function newPricing() : bool
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Disable SMTP debugging
            $mail->SMTPDebug = SMTP::DEBUG_OFF;

            // Set up SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["SMTP_MAIL"];
            $mail->Password   = $_ENV["SMTP_PASSWORD"];

            // Set character encoding to UTF-8
            $mail->CharSet    = "utf-8";

            // Set the sender's email address
            $mail->setFrom($_ENV["SMTP_MAIL"], 'Site AVEN Plaquiste');

            // Add a recipient
            $mail->addAddress($_ENV["SMTP_MAIL"], 'Admin');

            // Enable HTML in the email body
            $mail->isHTML(true);

            // Set email subject and body
            $mail->Subject = "Nouvelle demande de devis - AVEN Plaquiste";
            $mail->Body    = "Vous avez une nouvelle demande de devis sur le site d'AVEN Plaquiste. Rendez-vous vite en admin dans la rubrique 'DEVIS' !";

            // Send the email
            $mail->send();
            return true;
        } catch (Exception) {
            // Return false if there is an exception
            return false;
        }
    }
    protected function newOpinion() : bool
    {
        // Create a new PHPMailer instance
        $mail = new PHPMailer(true);

        try {
            // Disable SMTP debugging
            $mail->SMTPDebug = SMTP::DEBUG_OFF;

            // Set up SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->Port       = 587;
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV["SMTP_MAIL"];
            $mail->Password   = $_ENV["SMTP_PASSWORD"];

            // Set character encoding to UTF-8
            $mail->CharSet    = "utf-8";

            // Set the sender's email address
            $mail->setFrom($_ENV["SMTP_MAIL"], 'Site AVEN Plaquiste');

            // Add a recipient
            $mail->addAddress($_ENV["SMTP_MAIL"], 'Admin');

            // Enable HTML in the email body
            $mail->isHTML(true);

            // Set email subject and body
            $mail->Subject = "Nouvelle avis laissé - AVEN Plaquiste";
            $mail->Body    = "Quelqu'un a laissé un nouvel avis sur le site d'AVEN Plaquiste. Rendez-vous vite en admin dans la rubrique 'AVIS' !";

            // Send the email
            $mail->send();
            return true;
        } catch (Exception) {
            // Return false if there is an exception
            return false;
        }
    }
}
?>
