<?php
require_once("./models/Comment.php");
require_once("./models/Pictures.php");


if (isset($_GET['id'])) {
    $imageID = $_GET['id'];
    $image = Pictures::getImageById($imageID);
    if ($image) {
        $results = Comment::getComments($imageID);
		include "./views/layout.phtml";

    } else {
		// ID de l'image est invalide redirection home
		header("Location:?page=home");
    }
}