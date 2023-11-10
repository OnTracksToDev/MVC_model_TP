<?php
require_once("./services/database.php");
require_once("./models/Users.php");

// connect DB

$msgMail = '';
$msgName = '';
$msgFirstName = '';
$msgPassword = '';
$mail = '';
/************ INSERT NEW USER ************/
$bg = ''; // Initialiser la classe CSS à vide

if (isset($_POST['userNew'])) {
    $mail = strip_tags($_POST['mail']);
    $firstName = strip_tags($_POST['firstName']);
    $name = strip_tags($_POST['firstName']);
    $password = strip_tags($_POST['password']);

    //TEST MAIL VALID
    if (empty($_POST['mail'])) {
        $msgMail = 'Veuillez saisir une adresse e-mail.';
    } else {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if ((!empty($_POST['name'])) && (!empty($_POST['firstName'])) && (!empty($_POST['password']))) {
                $user = Users::getUserByMail($mail);
                //if empty results
                if (empty($user)) {
                    Users::createUser($name, $firstName, $mail, $password);
                    //  if error
                    if (isset($sqlError)) {
                        echo $sqlError;
                    }
                } else {
                    $msgExist = 'Le mail ' . $mail . ' n\'est pas dispo';
                    $msgMail = $msgExist;
                }
            }
        } else {
            $msgNoValidate = 'Désolé, le mail ' . $mail . ' n\'est pas valide ';
            $msgMail = $msgNoValidate;
        }
    }
    //TEST NAME
    if (empty($_POST['name'])) {
        $msgName = '<div id="nameHelp" class="form-text text-danger">Veuillez saisir un nom</div>';
    }
    //TEST FIRST NAME
    if (empty($_POST['firstName'])) {
        $msgFirstName = '<div id="firstNameHelp" class="form-text text-danger">Veuillez saisir un prénom</div>';
    }
    //TEST PASSWORD
    if (empty($_POST['password'])) {
        $msgPassword = '<div id="passwordHelp" class="form-text text-danger">Veuillez saisir un mot de passe</div>';
    }
}



// --- on charge la vue
include "./views/layout.phtml";
