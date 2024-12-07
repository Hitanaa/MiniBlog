<?php

// Connexion avec la base de donnée
include("../../../blog/controller/connection.php");

$obj = new Database();
$usersid = $obj->getstr($_POST['usersid']);
$fet = $obj->select('users', '*', "`usersid`='$usersid'");
$useremail = $obj->getstr($_POST['useremail']);
$username = $obj->getstr($_POST['username']);
$userpassword = $obj->getstr($_POST['userpassword']);
if (!empty($userpassword)) {
    $userpassword = password_hash($userpassword, PASSWORD_DEFAULT);
} else {
    $userpassword = $fet[0]['userpassword'];
}
$userstatus = $obj->getstr($_POST['userstatus']);
// ID utilisateur pour identifier quel utilisateur mettre à jour

// Sortie 1 s'il manque un champ pour signaler une erreur
if (empty($useremail) || empty($username) || empty($userstatus)) {
    echo 1; 
} else {
    
    // Vérifie si le fichier est téléchargé et traitez
    $userpic = $_FILES['userpic'];
    $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];

    if (!empty($userpic) && in_array($userpic['type'], $allowed_types)) {
        $extension = pathinfo($userpic['name'], PATHINFO_EXTENSION);
        $filename = 'userpic_' . uniqid() . '.' . $extension;

        // Déplace le fichier téléchargé vers le répertoire spécifié
        if (move_uploaded_file($userpic['tmp_name'], "../../../blog/user_pic/" . $filename)) {
            
            if (!empty($fet[0]['userpic'])) {
                unlink("../../../blog/user_pic/" . $fet[0]['userpic']);
            }
            $run = $obj->update(
                'users', 
                array(   
                    'useremail' => $useremail,
                    'username' => $username,
                    'userpassword' => $userpassword, // Mot de passe haché (sécurité)
                    'userstatus' => $userstatus,
                    'userpic' => $filename, 
                ),
                "usersid = $usersid" // Condition pour spécifier quel utilisateur mettre à jour en fonction de l'identifiant de l'utilisateur
            );

            // Message de réussite ou non
            if ($run) {
                echo 2; 
            } else {
                echo 3;
            }
        } else {
            echo 4; 
        }
    } else {
        $run = $obj->update(
            'users', 
            array(  
                'useremail' => $useremail,
                'username' => $username,
                'userpassword' => $userpassword, // Mot de passe haché (sécurité) (pareil qu'en haut)
                'userstatus' => $userstatus,
            ),
            "usersid = $usersid" // Condition pour spécifier quel utilisateur mettre à jour en fonction de l'identifiant de l'utilisateur (pareil qu'en haut)
        );

        if ($run) {
            echo 2; 
        } else {
            echo 3;
        }
    }
}
