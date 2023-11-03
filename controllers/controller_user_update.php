<?php
$db = connectDB();

$id = $_SESSION['userinfos']['id'];
$msg='';
if (isset($_POST['submit'])) {
    // Récup données de POST
    $firstName = strip_tags($_POST['firstName']);
    $name = strip_tags($_POST['name']);
    $mail = strip_tags($_POST['mail']);

    // REQUETE MAJ
    try {
        $sql = "UPDATE users SET firstName = ?, name = ?, mail = ?, dateUpdate=? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->execute(array(
            $firstName,
            $name,
            $mail,
            date('Y-m-d H:i:s'),
            $id
        ));
        $_SESSION['userinfos']['firstName'] = $firstName;
        $_SESSION['userinfos']['name'] = $name;
        $_SESSION['userinfos']['mail'] = $mail;
        $_SESSION['userinfos']['dateUpdate'] = date('Y-m-d H:i:s');
        ;
?>
       <?php $msg = '<span class="alert alert-success text center" role="alert" style="width: 20rem;">
  Mise à jour Réussie !</span>';
        ?> 

<?php
    } catch (Exception $e) {
        $sqlError = $e->getMessage();
    }
}

// --- on charge la vue
include "./views/layout.phtml";
