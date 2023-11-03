<?php
// Si le formulaire est validé on insert dans la table
if (isset($_POST['submit'])) {
    $db = connectDB();
    $sql = $db->prepare("INSERT INTO images (title, description, source, author) VALUES (?,?,?,?)");
    $sql->execute([
        $_POST['title'],
        $_POST['description'],
        $_POST['source'],
        $_POST['author']
    ]);
    // Et on redirige sur l'admin_list
    header("Location:?page=admin_list");
}

// --- la vue
include "./views/layout.phtml";
