
<?php
require_once("./services/database.php");


class Comment
{
    public static function getComments(string $imagesID)
    {
        $database = connectDB();
        $statement = $database->prepare(
            ("SELECT
        users.firstName AS name,
        users.id, 
        commentaires.comment,
        DATE_FORMAT(commentaires.dateComment, '%d/%m/%Y à %Hh%imin%ss') AS french_creation_date  
        FROM
        users
        JOIN
        commentaires
        ON
        users.id = commentaires.id_user
        WHERE id_image = ? ORDER BY dateComment DESC")

        );
        $statement->execute([$imagesID]);
        $comments = [];
        while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
            $comment = [
                'identifier' => $row['id'],
                'name' => $row['name'],
                'dateComment' => $row['french_creation_date'],
                'comment' => $row['comment'],
            ];
            $comments[] = $comment;
        }

        return $comments;
    }

    public static function createComment($imageID, $userID, $comment)
    {
        $database = connectDB();
        $statement = $database->prepare("INSERT INTO commentaires (id_image, id_user, comment, dateComment) VALUES (?, ?, ?, NOW()) ");
        // Lie un paramètre à variable 
        $statement->bindParam(1, $imageID);
        $statement->bindParam(2, $userID);
        $statement->bindParam(3, $comment);
        $affectedLines = $statement->execute();

        return ($affectedLines > 0);
    }
}
