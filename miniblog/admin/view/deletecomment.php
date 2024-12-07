<?php
 include("../../blog/controller/connection.php");

if (isset($_GET['commentid'])) {
      $commentid = $_GET['commentid'];
    $obj = new Database();

    $run = $obj->delete("comments", "commentid = '$commentid'");

    if ($run) {
        echo 1;
    } else {
       echo 2;
    }
}
?>
