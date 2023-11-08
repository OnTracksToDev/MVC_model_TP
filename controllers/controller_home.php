<?php
require_once("./models/Pictures.php");

$results = Pictures::getLastFourPictures();
// --- la vue
include "./views/layout.phtml";
