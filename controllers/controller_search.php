<?php

require_once("./models/Pictures.php");

$results = Pictures::searchBar();



// --- on charge la vue
include "./views/layout.phtml";
