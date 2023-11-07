<?php
require_once("./services/database.php");

class Users {


public static function updateUserProfile($id, $firstName, $name, $mail) {
    $db = connectDB();
    try {
        $sql = "UPDATE users SET firstName = ?, name = ?, mail = ?, dateUpdate = ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            $firstName,
            $name,
            $mail,
            date('Y-m-d H:i:s'),
            $id
        ));
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}


public static function getUserMail()
{
    $pdo = connectDB();
    $sql = $pdo->prepare("SELECT * FROM users WHERE mail=? LIMIT 1");
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        return null;
    }

    $user = [
        'identifier' => $row['id'],
        'firstName' => $row['firstName'],
        'mail' => $row['mail'],
    ];

    return $user;
}

// public static function calculateTimeElapsedSinceCreation() {
//     $db = connectDB();

//     $today = new DateTime(); // objet date actuelle
//     $dateCreation = new DateTime($_SESSION['userinfos']['dateCreate']); // objet date de création
//     $interval = $today->diff($dateCreation);

//     return $interval->format('%y years, %m months, %d days, %h hours, %i minutes');
// }



}