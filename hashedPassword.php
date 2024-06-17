<!--hachage du mot de passe pour base de donnée - et système de vérification du format du mot de passe déjà prévu en cas de mise en place d'un système d'inscription :-->

<?php

/*Si les deux mots de passe correspondent, la variable $password_pattern est définie avec une expression régulière.
if($_POST["password"] === $_POST["confirm-password"]) {
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])[A-Za-z\d^\w\s]{8,}$/';
}*/

/* Si le mot de passe est valide, il est haché à l'aide de la fonction password_hash avec l'algorithme PASSWORD_BCRYPT.*/

/*if (preg_match($password_pattern, $_POST["password"])) {*/
    $hashedPassword = password_hash('Admin@Aven@123!', PASSWORD_BCRYPT);
    echo $hashedPassword . "<br>";
/*}*/

?>


