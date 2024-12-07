<?php
include('./connection.php');
session_start();
$postid = $_POST['postid'];

$obj = new Database();
$sql = $obj->select('comments', '*', "post_id='$postid'", "INNER JOIN `users` ON comments.commentuser=users.useremail");

foreach ($sql  as $data) {
?>
    <div class="comment-section1">
        <div class="comment">
            <div class="avatar">
                <img src="<?php echo "../user_pic/" . $data['userpic']; ?>" alt="User Avatar">
            </div>
            <div class="comment-content">
                <div class="comment-header">
                    <span class="username"><?php echo $data['username'] ?></span>
                    <span class="timestamp"><?php echo $data['commentdate'] ?></span>
                </div>
                <div class="comment-text">
                <?php echo $data['comments'] ?>
                </div>

            </div>
        </div>
    </div>

<?php
}
?>