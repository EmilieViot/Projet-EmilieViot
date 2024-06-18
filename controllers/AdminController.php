<?php
class AdminController extends AbstractController
{
    public function admin(): void
    {
        $this->render("admin/admin.html.twig", []);
    }

    public function messagesList(): void
    {
        $mm = new MessageManager();
        $messages = $mm->findAll();

        $this->render("admin/contact/list-messages.html.twig", ["messages" => $messages]);
    }

    public function showMessage(int $id): void
    {
        $mm = new MessageManager();
        $message = $mm->getMessageById($id);
        $this->render("admin/contact/show-message.html.twig", ["message" => $message]);
    }
    public function deleteMessage(int $id): void
    {
        $mm = new MessageManager();
        $mm->deleteMessage($id);
        $this->redirect('list-messages');
    }

    public function opinionsList(): void
    {
        $om = new OpinionManager();
        $opinions = $om->findAll();
        $this->render("admin/opinions/list-opinions.html.twig", ["opinions" => $opinions]);
    }

    public function statusRegister(): void
    {

        if (!isset($_POST["status"]) && !isset($_POST["id"])) {
            $this->renderJson(['success' => false, 'message' => 'No input received']);
            return;
        }

        if (isset($_POST["status"]) && isset($_POST["id"])) {
                $status = htmlspecialchars($_POST["status"]);
                $id = (int)$_POST["id"];
                $om = new OpinionManager();
                $om->updateStatus($id, $status);
                $response = [' ' => 'status OK'];
        } else {
            $response = [' ' => 'error datas'];
        }
        $this->renderJson($response);
    }
    public function showOpinion(int $id): void
    {
        $om = new OpinionManager();
        $opinion= $om->getOpinionById($id);
        $this->render("admin/opinions/show-opinion.html.twig", ["opinion" => $opinion]);
    }

    public function editOpinion(int $id): void
    {
        $om = new OpinionManager();
        $opinion = $om->getOpinionById($id);

        $this->render("admin/opinions/edit-opinion.html.twig", ["opinion" => $opinion]);
    }

    public function checkEditOpinion(): void
    {
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photo_path']*/) {

            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                $dm = new DetailManager();
                $pm = new PricingManager();

                $contact_mode = htmlspecialchars($_POST["contact_mode"]);
                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $tel = htmlspecialchars($_POST["tel"]);
                $city = htmlspecialchars($_POST["city"]);
                $message = htmlspecialchars($_POST["message"]);

                $pricing = new Pricing($contact_mode, $firstname, $lastname, $email, $tel, $city, $message);
                unset($_SESSION["error-message"]);
                $sm->updateOpinion($service);

                $message = "L'avis a bien été mis à jour.";
                $this->render("admin/opinions/list-opinions.html.twig", ['message' => $message]);
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("edit-opinion");
            }
        } else {
            $message = "Une erreur s'est produite, veuillez réessayer.";
            $this->render("admin/opinions/edit-opinion.html.twig", ['message' => $message]);
        }
    }
    public function deleteOpinion(int $id): void
    {
        $om = new OpinionManager();
        $om->deleteOpinion($id);
        $this->redirect('list-opinions');
    }

    public function pricingsList(): void
    {
        $pm = new PricingManager();
        $pricings = $pm->findAll();
        $this->render("admin/pricing/list-pricings.html.twig", ["pricings" => $pricings]);
    }

    public function showPricing(int $id): void
    {
        $pm = new PricingManager();
        $pricing = $pm->findOne($id);
        $this->render("admin/pricing/show-pricing.html.twig", ["pricing" => $pricing]);
    }
    public function deletePricing(int $id): void
    {
        $pm = new PricingManager();
        $pm->deletePricing($id);
        $this->redirect('list-pricings');
    }

    public function realsList(): void
    {
        $rm = new RealisationManager();
        $realisations = $rm->findAll();
        $this->render("admin/realisations/list-reals.html.twig", ["realisations" => $realisations]);
    }

    public function createReal(): void
    {
        $this->render("admin/realisations/create-real.html.twig", []);
    }

    public function checkRealCreation(): void
    {
        if (isset($_POST['title']) && isset($_POST['description']) && (isset($_FILES['picture1']) || isset($_FILES['picture2']) || isset($_FILES['picture3']) || isset($_FILES['picture4']))) {

            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                if(!empty($_POST['title'])) {$title = $_POST['title'];} else {$title = null;}
                if(!empty($_POST['description'])) {$description = $_POST['description'];} else {$description = null;}
                if(!empty($_FILES['picture1'])) {$picture1 = $_FILES['picture1'];}
                if(!empty($_FILES['picture2'])) {$picture2 = $_FILES['picture2'];}
                if(!empty($_FILES['picture3'])) {$picture3 = $_FILES['picture3'];}
                if(!empty($_FILES['picture4'])) {$picture4 = $_FILES['picture4'];}

                $rm = new RealisationManager();

                /*dump($picture1);dump($picture2);dump($picture3);dump($picture4);*/

                $pictures = [];
                $uploader = new Uploader();

                for ($i = 1; $i <= 4; $i++) {
                    if (!empty($_FILES["picture$i"])) {
                        $pic = $uploader->uploadPictures($_FILES, "picture$i");
                        if ($pic !== null) {
                            $url = $pic->getUrl();
                            $alt = $pic->getAlt();
                            $newPic = new Picture($url, $alt);
                            $pictures[] = $newPic;
                            $pm = new PictureManager();
                            $pm->createPicture($newPic);
                        }
                    }
                }
                $realisation = new Realisation($title, $description, $pictures);
                $rm->createReal($realisation);
                if(!empty($pictures)){
                    $rpm = new RealisationPictureManager();
                    foreach ($pictures as $picture) {
                        $rpm->createOne($realisation, $picture);
                    }
                }
                $message = "Votre réalisation a été ajoutée avec succès.";
                $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);
                $this->redirect("list-reals");
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("create-real");
            }
        } else {
            $message = "Veuillez réessayer.";
            $this->render("admin/realisations/create-real.html.twig", ['message' => $message]);
            $this->redirect("create-real");
        }
    }

    public function showReal(): void
    {
        $rm = new RealisationManager();
        $realisation = $rm->findById();

        $this->render("admin/realisations/show-real.html.twig", ["realisation" => $realisation]);
    }

    public function deleteReal(int $id): void
    {
        $rm = new RealisationManager();
        $rm->deleteReal($id);
        $this->redirect('list-reals');
    }

    public function servicesList(): void
    {
        $sm = new ServiceManager();
        $services = $sm->findAll();

        $this->render("admin/services/list-services.html.twig", ["services" => $services]);
    }

    public function createService(): void
    {
        $this->render("admin/services/create-service.html.twig", []);
    }

    public function checkServiceCreation(): void
    {
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photo_path']*/) {
            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                $title = $_POST['title'];
                $intro = $_POST['intro'];
                $description = $_POST['description'];
                $service = new Service($title, $intro, $description);

                $sm = new ServiceManager();
                $sm->createService($service);

                $message = "Votre réalisation a bien été ajoutée.";
                $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);
                } else {
                    $_SESSION["error-message"] = "CSRF token invalide";
                    $this->redirect("edit-opinion");
                }
        } else {
            $message = "Veuillez réessayer.";
            $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);
        }
    }

    public function showService(): void
    {
        $sm = new ServiceManager();
        $service = $sm->findById();

        $this->render("admin/services/show-service.html.twig", ["service" => $service]);
    }

    public function editService(): void
    {
        $sm = new ServiceManager();
        $service = $sm->findById();

        $this->render("admin/services/edit-service.html.twig", ["service" => $service]);
    }

    public function checkEditService(): void
    {
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photo_path']*/) {

            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                $title = $_POST['title'];
                $intro = $_POST['intro'];
                $description = $_POST['description'];

                $sm = new ServiceManager();
                $sm->updateService($service);

                $message = "La prestation a bien été mise à jour.";
                $this->render("admin/realisations/list-services.html.twig", ['message' => $message]);
            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("edit-opinion");
            }
        } else {
            $message = "Une erreur s'est produite, veuillez réessayer.";
            $this->render("admin/services/edit-service.html.twig", ['message' => $message]);
        }
    }

}


