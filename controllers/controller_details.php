<?php
require_once("./models/Comment.php");
require_once("./models/Pictures.php");

if (isset($_GET['id'])) {
  $imageID = $_GET['id'];
  $image = Pictures::getImageById($imageID);
  if ($image) {
    $results = Comment::getComments($imageID);

    if (isset($_POST['submitComment'])) {
      if (!empty($_POST['author']) && !empty($_POST['comment'])) {
        $comment = $_POST['comment'];
        $author = $_POST['author'];
      } else {
        die('Les données du formulaire sont invalides.');
      }

      $success = Comment::createComment($imageID, $author, $comment);
      if (!$success) {
        die('Impossible d\'ajouter le commentaire !');
      } else {
        header('Location: index.php?action=post&id=' . $imageID);
      }
    }

  }
}

include "./views/layout.phtml";
