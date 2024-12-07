<?php 
// Inclu connexion bdd "miniblog"
 include('./connection.php'); 

// Démarre une nouvelle session ou reprends celle existante
 session_start(); 
 date_default_timezone_set(date_default_timezone_get());

 $obj = new Database(); 
 $comments = $obj->getstr($_POST['comments']);
 $post_id = $obj->getstr($_POST['post_id']);
 $commentuser=@$_SESSION['user'];
 $commentdate = date("d/m/y - H:i");

 if(empty($commentuser)){
    echo 1;
 }else{
    $run = $obj->insert("comments", [
        'comments' => $comments, 
        'post_id' => $post_id, 
        'commentuser' => $commentuser, 
        'commentdate' => $commentdate
    ]);
    if($run){
           echo 2;
    }else{
        echo 3;
    }

 }
?>