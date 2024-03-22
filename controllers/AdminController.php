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

    public function showMessage(): void
    {
        $mm = new MessageManager();
        $message = $mm->getMessageById();

        $this->render("admin/contact/show-message.html.twig", ["message" => $message]);
    }

    public function opinionsList(): void
    {
        $om = new OpinionManager();
        $opinions = $om->findAll();

        $this->render("admin/opinion/list-opinions.html.twig", ["opinions" => $opinions]);
    }

    public function showOpinion(): void
    {
        $om = new OpinionManager();
        $opinion = $om->getOpinionById();

        $this->render("admin/opinion/show-opinion.html.twig", ["opinion" => $opinion]);
    }

    public function editOpinion(): void
    {
        $om = new OpinionManager();
        $opinion = $om->getOpinionById();

        $this->render("admin/opinion/edit-opinion.html.twig", ["opinion" => $opinion]);
    }

    public function checkEditOpinion(): void
    {
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photoPath']*/) {

            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                $dm = new DetailManager();
                $pm = new PricingManager();

                $contactMode = htmlspecialchars($_POST["contactMode"]);
                $firstname = htmlspecialchars($_POST["firstname"]);
                $lastname = htmlspecialchars($_POST["lastname"]);
                $email = htmlspecialchars($_POST["email"]);
                $tel = htmlspecialchars($_POST["tel"]);
                $city = htmlspecialchars($_POST["city"]);
                $message = htmlspecialchars($_POST["message"]);

                $pricing = new Pricing($contactMode, $firstname, $lastname, $email, $tel, $city, $message);
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

    public function pricingsList(): void
    {
        $pm = new PricingManager();
        $pricings = $pm->findAll();
        /*dump($pricings[0]);*/

        $this->render("admin/pricing/list-pricings.html.twig", ["pricings" => $pricings]);
    }

    public function showPricing(): void
    {
        $pm = new PricingManager();
        $pricing = $pm->getPricingById();

        $this->render("admin/pricing/show-pricing.html.twig", ["pricing" => $pricing]);
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

                if(!empty($_POST['title'])) {$title = $_POST['title'];}
                if(!empty($_POST['description'])) {$description = $_POST['description'];}
                if(!empty($_FILES['picture1'])) {$picture1 = $_FILES['picture1'];}
                if(!empty($_FILES['picture2'])) {$picture2 = $_FILES['picture2'];}
                if(!empty($_FILES['picture3'])) {$picture3 = $_FILES['picture3'];}
                if(!empty($_FILES['picture4'])) {$picture4 = $_FILES['picture4'];}

                $rm = new RealisationManager();
                $pm = new PictureManager();

                /*dump($picture1);dump($picture2);dump($picture3);dump($picture4);*/

                $pictures = [];

                /*créa de la réal*/
                    /* image 1 */
                    $uploader = new Uploader();
                    $pic1 = $uploader->uploadPictures($_FILES, "picture1");
                    $url = $pic1->getUrl();
                    $alt = $pic1->getAlt();
                    $newPic1 = new Picture($url,$alt);
                    $pictures[]=$newPic1;
                    /*dump($newPic1);*/
                    $pm->createPicture($newPic1);
                    /* image 2 */
                    $uploader = new Uploader();
                    $pic2 = $uploader->uploadPictures($_FILES, "picture2");
                    $url = $pic2->getUrl();
                    $alt = $pic2->getAlt();
                    $newPic2 = new Picture($url,$alt);
                    $pictures[]=$newPic2;
                    /*dump($newPic2);*/
                    $pm->createPicture($newPic2);
                    /* image 3 */
                    $uploader = new Uploader();
                    $pic3 = $uploader->uploadPictures($_FILES, "picture3");
                    $url = $pic3->getUrl();
                    $alt = $pic3->getAlt();
                    $newPic3 = new Picture($url,$alt);
                    $pictures[]=$newPic3;
                    /*dump($newPic3);*/
                    $pm->createPicture($newPic3);
                    /* image 4 */
                    $uploader = new Uploader();
                    $pic4 = $uploader->uploadPictures($_FILES, "picture1");
                    $url = $pic4->getUrl();
                    $alt = $pic4->getAlt();
                    $newPic4 = new Picture($url,$alt);
                    $pictures[]=$newPic4;
                    /*dump($newPic1);*/
                    $pm->createPicture($newPic4);

                $realisation = new Realisation($title, $description, $pictures);
                $rm->createReal($realisation);

                $rm = new RealisationPictureManager();
                foreach ($pictures as $picture) {
                    $rm->createOne($realisation, $picture);
                }
                $message = "Votre réalisation a bien été ajoutée.";
                $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);

            } else {
                $_SESSION["error-message"] = "CSRF token invalide";
                $this->redirect("edit-real");
            }
        } else {
            $message = "Veuillez réessayer.";
            $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);
        }
    }

    public function showReal(): void
    {
        $rm = new RealisationManager();
        $realisation = $rm->findById();

        $this->render("admin/realisations/show-real.html.twig", ["realisation" => $realisation]);
    }

    public function editReal(): void
    {
        $rm = new RealisationManager();
        $realisation = $rm->findById();

        $this->render("admin/realisations/edit-real.html.twig", ["realisation" => $realisation]);
    }

    public function checkEditReal(): void
    {
        if (isset($_POST['title']) && isset($_POST['description']) /*&& $_POST['photoPath']*/) {

            $tokenManager = new CSRFTokenManager();
            if (isset($_POST["csrf-token"]) && $tokenManager->validateCSRFToken($_POST["csrf-token"])) {

                $title = $_POST['title'];
                $description = $_POST['description'];
                $realisation = new Realisation($title, $description);

                $rm = new RealisationManager();
                $rm->updateReal($realisation);

                $message = "La réalisation a bien été mise à jour.";
                $this->render("admin/realisations/list-reals.html.twig", ['message' => $message]);

                } else {
                    $_SESSION["error-message"] = "CSRF token invalide";
                    $this->redirect("edit-real");
                }
        } else {
            $message = "Une erreur s'est produite, veuillez réessayer.";
            $this->render("admin/realisations/edit-real.html.twig", ['message' => $message]);
        }
    }

    public function servicesList(): void
    {
        $sm = new ServicesManager();
        $services = $sm->findAll();

        $this->render("admin/services/list-services.html.twig", ["services" => $services]);
    }

    public function createService(): void
    {
        $this->render("admin/services/create-service.html.twig", []);
    }

    public function checkServiceCreation(): void
    {
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photoPath']*/) {
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
        if (isset($_POST['title']) && isset($_POST['intro']) && isset($_POST['description']) /*&& $_POST['photoPath']*/) {

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


