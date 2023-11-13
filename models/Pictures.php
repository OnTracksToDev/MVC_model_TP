<?php
require_once("./services/class/Database.php");


class Pictures
{
    public static function getAll()
    {
        $images = [];
        $db = new Database();
        $results = $db->query("SELECT * FROM images ORDER BY id DESC");
        foreach ($results as $row) {
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
        }
        return $images;
    }



    public static function getImageById($id)
    {
        $db = new Database();
        $result = $db->query("SELECT * FROM images WHERE id = ? LIMIT 1", [$id]);
        if (empty($result)) {
            return null;
        }
        $row = $result[0];
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




    public static function getLastFourPictures()
    {
        $images = [];
        $db = new Database();
        $results = $db->query("SELECT * FROM images ORDER BY id DESC LIMIT 4");
        foreach ($results as $row) {
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
        }
        return $images;
    }

    public static function searchBar()
    {
        if (!isset($_GET['query'])) {
            return [];
        }
        $db = new Database();
        $query = strtolower(strval(urldecode(trim($_GET['query']))));
        $results = $db->query("SELECT * FROM images WHERE title LIKE '%" . $query . "%' OR description LIKE '%" . $query . "%' OR source LIKE '%" . $query . "%' OR author LIKE '%" . $query . "%'");
        return $results;
    }

    // public function updateImage($id, $title, $description, $source, $author) {


    //     $pdo = connectDB();
    //     $sql = $pdo->prepare("UPDATE images SET title = ?, description = ?, source = ?, author = ?, updated_at = ? WHERE id = ?");
    //     $sql->execute([
    //         $title,
    //         $description,
    //         $source,
    //         $author,
    //         date('Y-m-d H:i:s'),
    //         $id
    //     ]);

    // }

}
