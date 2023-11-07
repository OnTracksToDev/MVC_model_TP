<?php
require_once("./services/database.php");

define("CONFIG_SITE_TITLE", "Mon modèle MVC PHP");
define("CONFIG_ROUTES", [
    "home" => "Home",
    "gallery" => "Gallery",
    "contact" => "Contact",
    "admin_list" => "Admin List",
]);
session_start();