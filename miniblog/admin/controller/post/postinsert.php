<?php



// Inclu connexion bdd "miniblog"
include("../../../blog/controller/connection.php"); 
session_start(); 
date_default_timezone_set(date_default_timezone_get()); 
$obj = new Database(); 



// Cette zone permets de récupère le nom de l'image, la date et l'heure, types d'images autorisés (jpg, png), type de fichier de l'image et le nom de l'admin
$posttitle = $obj->getstr($_POST['posttitle']);
$postcontent = $obj->getstr($_POST['postcontent']);
$postimage = $_FILES['postimage']['name']; 
$postdate = date("d/m/y - H:i");
$allowed_types = ['image/png', 'image/jpeg', 'image/jpg']; 
$file_type = $_FILES['postimage']['type'];
$postauthor = $_SESSION['admin']; 



// En dessous de ce commentaire, ce code permet de vérifier si les champs obligatoires sont vides ou non, si les images importés sont autorisé (png, jpg), prépare les données à être rentré dans la base de donnée et vérifie l'insertion des données a réussi sinon un message d'erreur apparaitra.
if (empty($posttitle) || empty($postcontent) || empty($postimage) || empty($postdate)) {
    echo 1;
} else {
    if (in_array($file_type, $allowed_types)) {
        $file_extension = pathinfo($postimage, PATHINFO_EXTENSION);
        $new_file_name = uniqid('img_', true) . '.' . $file_extension;

        $data = [
            'posttitle' => $posttitle,
            'postcontent' => $postcontent,
            'postimage' => $new_file_name, 
            'postdate' => $postdate,
            'postauthor' => $postauthor
        ];

        $run = $obj->insert("post", $data);

        if ($run) {
            move_uploaded_file($_FILES['postimage']['tmp_name'], "../../../blog/postimage/" . $new_file_name);
            echo 3; 
        } else {
            echo 4;
        }
    } else {
        echo 2;
    }
}
?>
