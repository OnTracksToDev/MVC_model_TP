<?php
$db = connectDB();
$message = '';
if (isset($_POST['submit'])) {
    if (!empty($_POST['source']) and !empty($_POST['title']) and !empty($_POST['description']) and !empty($_POST['author'])) {
        $source = htmlspecialchars($_POST['source']);
        $title = htmlspecialchars($_POST['title']);
        $description = nl2br(htmlspecialchars($_POST['description']));
        $author = htmlspecialchars($_POST['author']);

        $publierArticle = $db->prepare('INSERT INTO images(description, source, title, author) VALUES(?, ?, ?, ?)');
        $publierArticle->execute(array($description, $source, $title, $author));
        $message = "L'article a bien été envoyé";
    } else {
        $message = "Veuillez saisir tous les champs SVP";
    }
};
// --- on charge la vue
include "./views/layout.phtml";
/*
<script>
            setTimeout(function() {
                location.href = '?page=adminlist';
            }, 3000);
</script>*/