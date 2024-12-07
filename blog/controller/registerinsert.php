<?php 
include("./connection.php"); 
$obj = new Database(); 

// Récupère et nettoie les entrées utilisateur de la requête POST
$useremail = $obj->getstr($_POST['useremail']);
$username = $obj->getstr($_POST['username']);
$userpassword = $obj->getstr($_POST['userpassword']);
$userstatus = "user"; 


if (empty($useremail) || empty($username) || empty($userpassword) || empty($userstatus)) {
    echo 1; 
} else {
    // Vérifie si l'email existe ou non
    $emailrun = $obj->select('users', '*', "`useremail`='$useremail'");
    
    if (!empty($emailrun[0]['useremail'])) {
        echo 2; 
    } else {
        
        $run = $obj->insert("users", [
            'useremail' => $useremail, 
            'username' => $username, 
            'userpassword' => password_hash($userpassword, PASSWORD_DEFAULT), // mdp haché (sécurité)
            'userstatus' => $userstatus
        ]);

        if ($run) {
            echo 3; 
        } else {
            echo 4; 
        } 
    }
}
?>
