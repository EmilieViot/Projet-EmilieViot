<?php

class PricingController extends AbstractController
{
public function pricing() : void
    {
    $this->render("pricing", []);
    }

public function pricingProcessing() : void
{
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        // Récupération des données du formulaire
        $email = $_POST["email"];
        $telephone = $_POST["telephone"];
        $message = $_POST["message"];

        // Traitement de la photo
        if (isset($_FILES['photo']) && $_FILES['photo']['error'] == UPLOAD_ERR_OK) {
            $chemin_temporaire = $_FILES['photo']['tmp_name'];
            $nom_fichier = $_FILES['photo']['name'];

            $repertoire_destination = 'chemin/vers/repertoire/destination/';
            $chemin_final = $repertoire_destination . $nom_fichier;

            move_uploaded_file($chemin_temporaire, $chemin_final);
        } else {
            // Aucune photo téléchargée
            $chemin_final = null;
        }

        // Enregistrement des données dans la base de données

    }
    ?>