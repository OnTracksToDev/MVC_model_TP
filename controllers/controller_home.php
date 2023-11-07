<?php
require_once("./models/Pictures.php");

$result = Pictures::getLastFourPictures();
// --- la vue
include "./views/layout.phtml";
