<?php
require_once("./models/Users.php");
require_once("./services/database.php");
require_once("./models/Comment.php");


 $today = new DateTime(); // objet date actuelle
 $dateCreation = new DateTime($_SESSION['userinfos']['dateCreate']); // objet date de création
 $interval = $today->diff($dateCreation);
 $tempsEcoule = $interval->format('%y year, %m month, %d days, %h hours, %i minutes');
// --- on charge la vue
include "./views/layout.phtml";
