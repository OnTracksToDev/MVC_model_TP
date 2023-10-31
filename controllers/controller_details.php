<?php
$db = connectDB();
$sql = $db->prepare("SELECT * FROM images where id=?");
$sql->execute(array($_GET['id']));
$results = $sql->fetch(PDO::FETCH_ASSOC);
// --- on charge la vue
include "./views/layout.phtml";
