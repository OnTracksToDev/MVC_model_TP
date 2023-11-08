<?php
require_once("./models/Pictures.php");

$query = isset($_GET['query']) ? $_GET['query'] : '';
$results = Pictures::searchBar();

// --- on charge la vue
include "./views/layout.phtml";
