<?php
$info = "Ceci est la galerie...";

$db = connectDB();
$sql = $db->prepare("SELECT * FROM images ORDER BY id DESC ");
$sql->execute();
$results = $sql->fetchAll(PDO::FETCH_ASSOC);

// --- on charge la vue
require "./views/layout.phtml";
