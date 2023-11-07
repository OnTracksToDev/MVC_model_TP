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

    
    public static function getImageById($id)
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



public static function getLastFourPictures()
{
    $images = [];
    $pdo = connectDB();
    $sql = $pdo->prepare("SELECT * FROM images ORDER BY id DESC LIMIT 4");
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


public static function searchBar(){
    $db = connectDB();
    // on récupère la chaine de recherche depuis l'url
    // on la convertit en texte en enlevant les espace...
    $query = strtolower(strval(urldecode(trim($_GET['query']))));
    $sql = $db->prepare("SELECT * FROM images WHERE title LIKE '%" . $query . "%' OR description LIKE '%" . $query . "%' OR source LIKE '%" . $query . "%' OR author LIKE '%" . $query . "%'");
    $sql->execute();
    $results = $sql->fetchAll(PDO::FETCH_ASSOC);
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
