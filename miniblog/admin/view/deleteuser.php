<?php
include("../../blog/controller/connection.php");
$userid = $_GET['userid'];
$obj = new Database();

$fet = $obj->select('users', '*', "`usersid`='$userid'");

// Supprime le fichier image du serveur
$image_name=$fet[0]['userpic'];
if (!empty($image_name) && file_exists("../../blog/user_pic/" . $image_name)) {
     unlink("../../blog/user_pic/" . $image_name);
}

$run = $obj->delete("users", "usersid = '$userid'");

if ($run) {
     echo 1;
}
