<?php
session_start();
include('../controller/connection.php');
$obj = new Database();
$fet = $obj->select("post", "*", null,"INNER JOIN users ON post.postauthor=users.useremail", null,"`postid` DESC", null);
include('./include/header.php');
?>





<div class="container">
    <?php
    $a = 1;
    foreach ($fet as $postdata) {
        if ($a%2 == 0) {
            $style = "style='left: -14%;'";
        }
    ?>
        <div class="post" <?php echo @$style; ?>>
            <div class="inner-border">
                <img class="postpic" src="<?php echo "../postimage/" . $postdata['postimage']; ?>" alt="">
                <a href="../view/view-more.php?postid=<?php echo $postdata['postid'] ?>" style="text-decoration: none;" class="view-more">Voir plus</a>
                <div class="post-date"><span style="float:right"><?php echo $postdata['username']; ?></span><br><?php echo $postdata['postdate']; ?></div>
            </div>
        </div>
    <?php
        $style = "";
        $a++;
    }
    ?>


</div>



<?php
include('./include/sidebar.php');
?>