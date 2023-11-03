<?php
$db = connectDB();
$sql = $db->prepare("SELECT * FROM images where id=?");
$sql->execute(array($_GET['id']));
$results = $sql->fetch(PDO::FETCH_ASSOC);

function getComments(string $images)
{
	$database = connectDB();
	$statement = $database->prepare(
    	"SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE images_id = ? ORDER BY comment_date DESC"
	);
	$statement->execute([$images]);

	$comments = [];
	while (($row = $statement->fetch())) {
    	$comment = [
        	'author' => $row['author'],
        	'french_creation_date' => $row['french_creation_date'],
        	'comment' => $row['comment'],
    	];
    	$comments[] = $comment;
	}

	return $comments;
}

$comments = getComments($_GET['id']);

function createComment(string $post, string $author, string $comment)
{
	$database = connectDB();
	$statement = $database->prepare(
    	'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
	);
	$affectedLines = $statement->execute([$post, $author, $comment]);

	return ($affectedLines > 0);
}


function addComment(string $post, array $input)
{
	$author = null;
	$comment = null;
	if (!empty($input['author']) && !empty($input['comment'])) {
    	$author = $input['author'];
    	$comment = $input['comment'];
	} else {
    	die('Les données du formulaire sont invalides.');
	}

	$success = createComment($post, $author, $comment);
	if (!$success) {
    	die('Impossible d\'ajouter le commentaire !');
	} else {
    	header('Location: index.php?action=post&id=' . $post);
	}
}

// --- on charge la vue
include "./views/layout.phtml";
