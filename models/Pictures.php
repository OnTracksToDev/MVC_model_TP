<?php
require_once("./services/database.php");

class Pictures
{
    public static function getAll()
    {
        $images = [];
        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT * FROM images ORDER BY id DESC");
        $sql->execute();
        while ($row = $sql->fetch(PDO::FETCH_ASSOC)) {
            $image = [
                'identifier' => $row['id'],
                'title' => $row['title'],
                'description' => $row['description'],
                'source' => $row['source'],
                'created_at' => $row['created_at'],
                'updated_at' => $row['updated_at'],
                'author' => $row['author'],
            ];

            $images[] = $image;
        };
        return $images;
    }

    
    public static function getById($id)
    {
        $pdo = connectDB();
        $sql = $pdo->prepare("SELECT * FROM images WHERE id = ? LIMIT 1");
        $sql->execute([$id]);
        $row = $sql->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return null;
        }

        $image = [
            'identifier' => $row['id'],
            'title' => $row['title'],
            'description' => $row['description'],
            'source' => $row['source'],
            'created_at' => $row['created_at'],
            'updated_at' => $row['updated_at'],
            'author' => $row['author'],
        ];

        return $image;
    }
}



