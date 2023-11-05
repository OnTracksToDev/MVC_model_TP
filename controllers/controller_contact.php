<?php
// connect DB
$db = connectDB();

$msgMail = '';
$msgName = '';
$msgFirstName = '';
$msgPassword = '';
$mail = '';
/************ INSERT NEW USER ************/
$bg = ''; // Initialiser la classe CSS à vide

if (isset($_POST['userNew'])) {
    $mail = strip_tags($_POST['mail']);
    $password = strip_tags($_POST['password']);
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    //TEST MAIL VALID
    if (empty($_POST['mail'])) {
        $msgMail = 'Veuillez saisir une adresse e-mail.';
       


    } else {
        if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
            if ((!empty($_POST['name'])) && (!empty($_POST['firstName'])) && (!empty($_POST['password']))) {
                //MAIL OK
                //TEST MAIL EXIST
                //search mail in table users
                try {
                    $sql = "SELECT * FROM users WHERE mail=?";
                    $stmt = $db->prepare($sql);
                    $stmt->execute(array($mail));
                } catch (Exception $e) {
                    $sqlError = $e->getMessage();
                }

                //if empty results
                if ($stmt->rowCount() == 0) {
                    //INSERT
                    // requete INSERT NEW USER
                    try {
                        $sql = "INSERT INTO users SET name=?, firstName=?, mail=?, password=?";
                        $stmt = $db->prepare($sql);
                        $stmt->execute(array(
                            strip_tags($_POST['name']),
                            strip_tags($_POST['firstName']),
                            $mail,
                            $hashedPassword
                        ));
                    } catch (Exception $e) {
                        $sqlError = $e->getMessage();
                    }
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
