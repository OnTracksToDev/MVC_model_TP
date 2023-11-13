
<?php
require_once("./services/class/Database.php");

class Comment
{
    public static function getComments(string $imagesID)
    {
        $db = new Database(); 
        $statement = $db->query(
            "SELECT
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
            WHERE id_image = ? ORDER BY dateComment DESC",
            [$imagesID]
        );

        $comments = [];
        foreach ($statement as $row) {
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
        $db = new Database(); 
        $statement = $db->query("INSERT INTO commentaires (id_image, id_user, comment, dateComment) VALUES (?, ?, ?, NOW()) ", [$imageID, $userID, $comment]);

        return ($statement > 0);
    }
}
