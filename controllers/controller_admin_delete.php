<?php
// Si l'id est dans l'url on delete dans la table
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $db = connectDB();
    $sql = $db->prepare("DELETE FROM images WHERE id=?");
    $sql->execute([$id]);
    // Et on redirige sur l'admin_list
    header("Location:?page=admin_list");
}
