<?php
$errors = [];

$upload_max_filesize =  ini_get('upload_max_filesize');

if (isset($_POST['upload'])){
    
    $tempFile = $_FILES["image_file"]["tmp_name"];
    $fileType = $_FILES["image_file"]["type"];
    $fileSize = $_FILES["image_file"]["size"];
    $acceptedType = ["png","jpeg"];
    $tabFileName = !empty($fileType) ? explode("/",$fileType) : [1=>""];
    $fileExt = $tabFileName[1];

    if ($fileSize > $upload_max_filesize) {
        $errors[] ="Le fichier est trop gros !";
    }
    
    if (empty($fileSize)) {
        $errors[] ="Fichier non traité. Vérifiez éventuellement qu'il ne soit pas trop gros...";
    }
    
    if (!in_array($fileExt,$acceptedType)){
        $errors[] ="Le fichier doit être un .jpg, .jpeg ou .png uniquement";
    }
      
    if (empty($errors)){
        
        $newFile = "./uploads/". time() .".".$fileExt;
        if (@move_uploaded_file($tempFile,$newFile)) {
            $success = true;
        } else {
            $errors[] ="Erreur lors de l'upload du fichier :(";  
        }
    } 
}

include "./views/layout.phtml";