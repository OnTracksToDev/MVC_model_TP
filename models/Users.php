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


public static function getUserByMail($mail)
{
    $pdo = connectDB();
    $sql = $pdo->prepare("SELECT * FROM users WHERE mail = :mail LIMIT 1");
    $sql->bindParam(':mail', $mail, PDO::PARAM_STR);
    $sql->execute();
    $row = $sql->fetch(PDO::FETCH_ASSOC);


    if (!$row) {
        return null;
    }

    $user = [
        'identifier' => $row['id'],
        'firstName' => $row['firstName'],
        'name' => $row['name'],
        'mail' => $row['mail'],
        'dateCreate' => $row['dateCreate'],
        'dateUpdate' => $row['dateUpdate'],
        'password' => $row['password'],
        'id_role' => $row['id_role']
    ];

    return $user;
}


public static function getUserRole($userId) {
    $pdo = connectDB();

    $sql = $pdo->prepare("SELECT r.name FROM users u JOIN roles r ON u.id_role = r.id WHERE u.id = :userId");
    $sql->bindParam(':userId', $userId, PDO::PARAM_INT);
    $sql->execute();

    $result = $sql->fetch(PDO::FETCH_ASSOC);

    if ($result) {
        return $result['name']; 
    } else {
        return null;
    }
}
// public static function calculateTimeElapsedSinceCreation() {
//     $db = connectDB();

//     $today = new DateTime(); // objet date actuelle
//     $dateCreation = new DateTime($_SESSION['userinfos']['dateCreate']); // objet date de création
//     $interval = $today->diff($dateCreation);

//     return $interval->format('%y years, %m months, %d days, %h hours, %i minutes');
// }



}