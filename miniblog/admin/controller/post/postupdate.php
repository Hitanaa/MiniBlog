<?php

// Inclu connexion bdd "miniblog"
include("../../../blog/controller/connection.php");
session_start();
date_default_timezone_set(date_default_timezone_get());
$obj = new Database();

$postid = $obj->getstr($_POST['postid']); 
$fet = $obj->select('post', '*', "`postid`='$postid'");


$posttitle = $obj->getstr($_POST['posttitle']);
$postcontent = $obj->getstr($_POST['postcontent']);
$postauthor = $_SESSION['admin'];
$postdate = date("d/m/y - H:i");

// Vérifiez si une nouvelle image est sélectionnée
$postimage = $_FILES['postimage']['name'];
$file_type = $_FILES['postimage']['type'];
$allowed_types = ['image/png', 'image/jpeg', 'image/jpg'];

if (empty($posttitle) || empty($postcontent) || empty($postdate)) {
    echo 1;
} else {
    // Requête de mise à jour selon qu'une nouvelle image est téléchargée ou non
    if (!empty($postimage) && in_array($file_type, $allowed_types)) {
        $file_extension = strtolower(pathinfo($postimage, PATHINFO_EXTENSION));
        $new_file_name = uniqid('img_', true) . '.' . $file_extension;

        // Requête SQL pour mettre à jour la publication avec une nouvelle image
        $run = $obj->update(
            'post',
            array(
                'posttitle' => $posttitle,
                'postcontent' => $postcontent,
                'postimage' => $new_file_name,
                'postauthor' => $postauthor,
                'update_date' => $postdate,
            ),
            "postid = $postid"
        );

    
        if ($run) {
           // Déplace la nouvelle image vers le dossier de téléchargement et supprime l'ancienne
            if (move_uploaded_file($_FILES['postimage']['tmp_name'], "../../../blog/postimage/" . $new_file_name)) {
                if (!empty($postimage) && file_exists("../../../blog/postimage/" . $fet[0]['postimage'])) {

                    // Supprime l'ancienne image (car il y a une nouvelle image comme dis précédemment)
                    unlink("../../../blog/postimage/" . $fet[0]['postimage']); 
                 
                }
                echo 3;
            } 
        } else {
          echo 4;
        }

    } else {
        // Requête SQL pour mettre à jour la publication sans changer l'image
        $run = $obj->update(
            'post',
            array(
                'posttitle' => $posttitle,
                'postcontent' => $postcontent,
                'postauthor' => $postauthor,
                'update_date' => $postdate,
            ),
            "postid = $postid"
        );
        if ($run) {
          echo 3;
        } else {
           echo 4;
        }
    }
}
