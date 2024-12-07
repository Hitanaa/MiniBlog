<?php

include("./connection.php");

$obj = new Database();
$usersid = $obj->getstr($_POST['usersid']);
$fet = $obj->select('users', '*', "`usersid`='$usersid'");
$useremail = $obj->getstr($_POST['useremail']);
$username = $obj->getstr($_POST['username']);
$userpassword = $obj->getstr($_POST['userpassword']);
if(!empty($userpassword)){
$userpassword=password_hash($userpassword, PASSWORD_DEFAULT);
}else{
    $userpassword=$fet[0]['userpassword'];
}
$userstatus = "user";
// ID utilisateur pour identifier quel utilisateur mettre à jour

if (empty($useremail) || empty($username) || empty($userstatus)) {
    echo 1; 
} else {

    $userpic = $_FILES['userpic'];
    $allowed_types = ['image/jpg', 'image/jpeg', 'image/png'];

    if (!empty($userpic) && in_array($userpic['type'], $allowed_types)) {
        $extension = pathinfo($userpic['name'], PATHINFO_EXTENSION);
        $filename = 'userpic_' . uniqid() . '.' . $extension;
    
        if (move_uploaded_file($userpic['tmp_name'], "../user_pic/".$filename)) {
            if(file_exists("../user_pic/".$fet[0]['userpic'])){
               unlink("../user_pic/".$fet[0]['userpic']);
            }
            $run = $obj->update(
                // Nom de la table à mettre à jour
                'users', 
                array( 
                    'useremail' => $useremail,
                    'username' => $username,
                    'userpassword' =>$userpassword , // mdp haché (sécurité)
                    'userstatus' => $userstatus,
                    'userpic' => $filename, 
                ),
                "usersid = $usersid" // Condition pour spécifier quel utilisateur mettre à jour en fonction de l'ID utilisateur
            );

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
                'userpassword' => $userpassword,
                'userstatus' => $userstatus,
            ),
            "usersid = $usersid" // Condition pour spécifier quel utilisateur mettre à jour en fonction de l'ID utilisateur
        );

        if ($run) {
            echo 2; 
        } else {
            echo 3;
        }
    }
}
?>
