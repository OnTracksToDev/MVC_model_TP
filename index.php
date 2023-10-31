<?php
// --- la config
require "./config.php";
// --- le routeur
require "./services/router.php";
// --- le controlleur
require "./controllers/controller_{$page}.php";
