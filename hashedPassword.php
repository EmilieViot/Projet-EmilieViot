<!--hachage du mot de passe pour base de donnée - et système de vérification du format du mot de passe déjà prévu en cas de mise en place d'un système d'inscription :-->

<?php
if($_POST["password"] === $_POST["confirm-password"]) {
    $password_pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\d\s])[A-Za-z\d^\w\s]{8,}$/';
}

if (preg_match($password_pattern, $_POST["password"])) {
    $hashedPassword = password_hash('Admin@Aven@123!', PASSWORD_BCRYPT);
    echo $hashedPassword . "<br>";
}
?>