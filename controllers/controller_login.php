<?php
require_once("./services/database.php");
require_once("./models/Users.php");

$successMessage = '';
$errorMessage = '';
$showForm = true;

// Validation du formulaire
if (isset($_POST['submit'])) {
    $mail = filter_var($_POST['mail']);
    $password = $_POST['password'];

    if (!empty($mail) && !empty($password)) {
        $user = Users::getUserByMail($mail);
        // Authentification 
        if ($user) {
            // Vérification du mot de passe
            $hashedPasswordFromDatabase = $user['password'];
            if (password_verify($password, $hashedPasswordFromDatabase)) {
                $successMessage = 'Connexion réussie !';
                $_SESSION['userinfos'] = $user;
            } else {
                header("Location:?page=profil");
            }
        }
    } else {
        $errorMessage = 'Les informations envoyées ne permettent pas de vous identifier.';
    }
}



// --- on charge la vue
include "./views/layout.phtml";
