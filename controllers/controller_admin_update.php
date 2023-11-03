<?php
$db = connectDB();
// on récupère l'id depuis l'url
// on la convertit en entier pour être plus prudent...
$id = intval($_GET['id']);
$sql = $db->prepare("SELECT * FROM images WHERE id='" . $id . "'");
$sql->execute();
// LE FETCH TOUT COURT NE RETOURNE QU'UN SEUL ARRAY PLAT
$image = $sql->fetch(PDO::FETCH_ASSOC);
// Si le formulaire est validé on update dans la table
// Sans oublier de préciser l'id
if (isset($_POST['submit'])) {
    $sql = $db->prepare("UPDATE images SET title=?, description=?, source=?, author=?, updated_at=? WHERE id=?");
    $sql->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['source'],
        $_POST['author'],
        date('Y-m-d H:i:s'), // on peut directement utiliser l'objet DateTime de PHP natif
        $id
    ]);
    // Et on redirige sur l'adminlist
    header("Location:?page=admin_list");
}

// --- la vue
include "./views/layout.phtml";
