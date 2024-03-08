<?php

class AuthController extends AbstractController
{
    public function login(): void
    {
        $this->render("admin/login", []);
    }

    public function loginCheck(): void
    {
        if (isset($_POST["email"]) && isset($_POST["password"])) {

            $tokenManager = new CSRFTokenManager();

            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"]))
            {
                $um = new UserManager();
                $user = $um->findByEmail($_POST["email"]);

                if ($user !== null)
                {
                    if (password_verify($_POST["password"], $user->getPassword())) {
                        $_SESSION["user"] = $user->getId();

                        unset($_SESSION["error-message"]);

                        $this->redirect("index.php?route=admin");
                    }
                    else
                    {
                        $_SESSION["error-message"] = "Informations incorrectes, veuillez réessayer.";
                        $this->redirect("index.php?route=login");
                    }
                }
                else
                {
                    $_SESSION["error-message"] = "Informations incorrectes, veuillez réessayer.";
                    $this->redirect("index.php?route=login");
                }
            }
            else
            {
                $_SESSION["error-message"] = "Token CSRF invalide";
                $this->redirect("index.php?route=home");
            }
        }
        else
        {
            $_SESSION["error-message"] = "Champs manquants";
            $this->redirect("index.php?route=login");
        }
    }
}