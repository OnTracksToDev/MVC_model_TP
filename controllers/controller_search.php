<?php

require_once("./models/Pictures.php");

$result = Pictures::searchBar();



// --- on charge la vue
include "./views/layout.phtml";
