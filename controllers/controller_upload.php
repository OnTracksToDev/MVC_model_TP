<?php

$errors = [];

if (isset($_POST['upload'])) {
    // On copie le fichier temporaire vers 
    // le dossier UPLOADS de notre projet.
    $tempFile = $_FILES["image_file"]["tmp_name"];
    // On peut récupérer des infos sur le fichier  
    // temporaire avec "GETIMAGESIZE()"
    
    $checkFile = getimagesize($tempFile);
    if (!$checkFile) {
        $errors[] = "Fichier invalide";
    } else {
        $extenssionFile = explode("/",$checkFile['mime']);
        $ext= $extenssionFile[1];
        // On precise le nom du fichier basé sur un timestamp
        $newFile = "./uploads/" . time() . ".".$ext;
        $allowedExt = ['jpeg','jpg','png','gif'];
        if (!in_array($ext,$allowedExt)) {
            $errors[] = "Nous n'acceptons que les images jpeg, jpg, png, gif merci";
        } else if ($_FILES["image_file"]["size"] > 1000000) {
            $errors[] = "Fichier trop volumineux";
        } else {
            move_uploaded_file($tempFile, $newFile);
        }
    }
}

if (!empty($errors)) {
    // On affiche les erreurs
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}



include "./views/layout.phtml";
