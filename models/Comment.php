
<?php
require_once("./services/database.php");


class Comment
{
    public static function getComments(string $imagesID)
    {
        $database = connectDB();
        $statement = $database->prepare(
            "SELECT id, author, comment, DATE_FORMAT(comment_date, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date FROM comments WHERE images_id = ? ORDER BY comment_date DESC"
        );
        $statement->execute([$imagesID]);

        $comments = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $comment = [
                'author' => $row['author'],
                'comment_date' => $row['french_creation_date'],
                'comment' => $row['comment'],
            ];
            $comments[] = $comment;
        }

        return $comments;
    }


    public static function createComment(string $post, string $author, string $comment)
    {
        $database = connectDB();
        $statement = $database->prepare(
            'INSERT INTO comments(post_id, author, comment, comment_date) VALUES(?, ?, ?, NOW())'
        );
        $affectedLines = $statement->execute([$post, $author, $comment]);

        return ($affectedLines > 0);
    }


    public static function addComment(string $post, array $input)
    {
        $author = null;
        $comment = null;
        if (!empty($input['author']) && !empty($input['comment'])) {
            $author = $input['author'];
            $comment = $input['comment'];
        } else {
            die('Les données du formulaire sont invalides.');
        }

        $success = self::createComment($post, $author, $comment);
        if (!$success) {
            die('Impossible d\'ajouter le commentaire !');
        } else {
            header('Location: index.php?action=post&id=' . $post);
        }
    }
}
