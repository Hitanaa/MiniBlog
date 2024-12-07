<?php
 include("../../blog/controller/connection.php");

if (isset($_GET['postid'])) {
    $postid = $_GET['postid'];
    $obj = new Database();
    $fet = $obj->select('post', '*', "`postid`='$postid'");

    // Récupère le nom de l'image pour la suppression
    $image_name = $fet[0]['postimage'];
    
    // Supprime le fichier image du serveur
    if (!empty($image_name) && file_exists("../../blog/postimage/" . $image_name)) {
        unlink("../../blog/postimage/" . $image_name);
    }
    
   // Supprime le message de la base de données
    $run = $obj->delete("post", "postid = '$postid'");

    if ($run) {
       echo 1;
    } else {
       echo 2;
    }
}
?>
