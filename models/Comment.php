
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
                'name' => $row['name'],
                'dateComment' => $row['french_creation_date'],
                'comment' => $row['comment'],
            ];
            $comments[] = $comment;
        }

        return $comments;
    }

    public static function createComment($imageID, $author, $comment)
    {
        $database = connectDB();
        $statement = $database->prepare("INSERT INTO commentaires (id_image, author, comment, comment_date) VALUES (?, ?, ?, NOW()) ");

        // Bind parameters using 1-based indexing
        $statement->bindParam(1, $author);
        $statement->bindParam(2, $comment);
        $statement->bindParam(3, $imageID);

        // Execute the statement
        $affectedLines = $statement->execute();

        return ($affectedLines > 0);
    }
}
