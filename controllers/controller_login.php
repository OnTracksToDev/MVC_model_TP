<?php
// Connecter DB
$db = connectDB();

//  message rapport
$successMessage = '';
$errorMessage = '';
$showForm = true;
// Validation du formulaire
if (isset($_POST['submit'])) {
    $mail = filter_var($_POST['mail']);
    $password = $_POST['password'];

    if (!empty($mail) && !empty($password)) {
        $sql = $db->prepare("SELECT * FROM users WHERE mail=?");
        $sql->execute(array($mail));
        $user = $sql->fetch(PDO::FETCH_ASSOC);

        // Authentification 
        if ($user) {
            // Vérification du mot de passe
            $hashedPasswordFromDatabase = $user['password'];
            if (password_verify($password, $hashedPasswordFromDatabase)) {
                // Mot de passe correct, connectez l'utilisateur
                $successMessage = 'Connexion réussie !'; // Message de succès
                $_SESSION['userinfos'] = $user;
                header("Location:?page=profil");
            } 
        }else {
            $errorMessage = 'Les informations envoyées ne permettent pas de vous identifier.'; // Message d'erreur
        }
    }
}
// --- on charge la vue
include "./views/layout.phtml";
