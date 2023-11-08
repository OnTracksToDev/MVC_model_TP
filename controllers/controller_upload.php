<?php

$error = "";

if (isset($_POST['upload'])) {
    // On copie le fichier temporaire vers 
    // le dossier UPLOADS de notre projet.
    $tempFile = $_FILES["image_file"]["tmp_name"];
    // On peut récupérer des infos sur le fichier  
    // temporaire avec "GETIMAGESIZE()"
    
    $checkFile = getimagesize($tempFile);
    if ($checkFile) {
        $extenssionFile = explode("/",$checkFile['mime']);
        $ext= $extenssionFile[1];
        // On precise le nom du fichier basé sur un timestamp
        $newFile = "./uploads/" . time() . ".".$ext;
        $allowedExt = ['jpeg','jpg','png','gif'];
        if(in_array($ext,$allowedExt)){

            move_uploaded_file($tempFile, $newFile);
        }
    } else {
        $error =" Nous n'acceptons que les images merci";
    }
}




include "./views/layout.phtml";
