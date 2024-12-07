<?php
include('./connection.php'); 
session_start(); 

$obj = new Database(); 

// Récupère et nettoie l'e-mail et le mot de passe de l'utilisateur à partir de la requête POST
$useremail = $obj->getstr($_POST['useremail']);
$userpassword = $obj->getstr($_POST['userpassword']);

// Vérifiez si les champs email ou mot de passe sont vides
// Interroge la base de données pour trouver l'utilisateur avec l'e-mail fourni
if (empty($useremail) || empty($userpassword)) {
    echo 1; 
} else {
    $sql = $obj->select('users', '*', "`useremail`='$useremail'");
    
    // Vérifie si l'email existe ou non
    // Vérifiez si le mot de passe fourni correspond au mot de passe haché stocké dans la base de données
    // Vérifiez le statut de l'utilisateur pour déterminer s'il s'agit d'un administrateur ou d'un utilisateur régulier
    if (!empty($sql[0]['useremail'])) {
        if (password_verify($userpassword, $sql[0]['userpassword'])) {
            if ($sql[0]['userstatus'] == 'admin') {
                $_SESSION['admin'] = $useremail; 
                echo 3;
            } else {
                $_SESSION['user'] = $useremail; 
                echo 4;
            }
        } else {
            echo 2;
        }
    } else {
        echo 2;
    }
}
?>
