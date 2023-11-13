<?php
require_once("./models/Users.php");

$id = $_SESSION['userinfos']['id'];
$msg = '';

if (isset($_POST['submit'])) {
    $firstName = strip_tags($_POST['firstName']);
    $name = strip_tags($_POST['name']);
    $mail = strip_tags($_POST['mail']);

    $updateResult = Users::updateUserProfile($id, $firstName, $name, $mail);

    if ($updateResult === true) {
        $_SESSION['userinfos']['firstName'] = $firstName;
        $_SESSION['userinfos']['name'] = $name;
        $_SESSION['userinfos']['mail'] = $mail;
        $_SESSION['userinfos']['dateUpdate'] = date('Y-m-d H:i:s');
        $msg = '<span class="alert alert-success text center" role="alert" style="width: 20rem;">Mise à jour Réussie !</span>';
    } else {
        $sqlError = $updateResult;
    }
}

// Charge la vue
include "./views/layout.phtml";

