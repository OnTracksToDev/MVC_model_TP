<?php
// Si la variable page est définie dans l'url
// On utilise page pour trouver le controlleur 

// Sinon la page c'est home et le controlleur c'est 
// controller_home.php (logique)


$getPage = isset($_GET['page']) ? strtolower($_GET['page']) : "";
$page = isset($getPage) && file_exists("./controllers/controller_".$getPage.".php") ? $getPage : array_key_first(CONFIG_ROUTES);