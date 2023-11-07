<?php
require_once("./models/Pictures.php");
$info = "Ceci est la galerie...";


$results = Pictures::getAll();
// --- on charge la vue
require "./views/layout.phtml";
