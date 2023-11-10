<?php
require_once("./models/Comment.php");
require_once("./models/Pictures.php");

$errors = [];

if (isset($_GET['id'])) {
    $imageID = $_GET['id'];
    $image = Pictures::getImageById($imageID);

    if ($image) {
        $results = Comment::getComments($imageID);

        if (isset($_POST['submitComment'])) {
            if (!empty($_POST['id_user']) && !empty($_POST['comment'])) {
                $comment = $_POST['comment'];
                $author = intval($_POST['id_user']);
            } else {
                $errors[] = 'Les données du formulaire sont invalides.';
            }

            if (empty($errors)) {
                $success = Comment::createComment($imageID, $author, $comment);

                if ($success) {
                    header('Location: ?page=details&id='.$imageID);
                    exit();
                } else {
                    $errors[] = 'Impossible d\'ajouter le commentaire !';
                }
            }
        }
    }
}

include "./views/layout.phtml";







