<?php
session_start();
include('../controller/connection.php');
$postid = $_GET['postid'];
$obj = new Database(); 
$fet = $obj->select("post", "*", "postid='$postid'", "INNER JOIN users ON post.postauthor=users.useremail", null, null, null);

include('./include/header.php');
?>

<!-- Conteneur de contenu principal -->
<div class="container">
    <div class="post-view-more">
        <div class="inner-border">
            <img class="postviewpic" src="<?php echo "../postimage/" . $fet[0]['postimage']; ?>" alt="">

            <button id="showandhide" class="view-more" onclick="toggleComments()">
                Voir les commentaires</button>
            <div class="post-date"><span style="float:right"><?php echo $fet[0]['username']; ?></span><br><?php echo $fet[0]['postdate']; ?></div>
        </div>
        <p style="text-align: left;" ><?php echo $fet[0]['postcontent'] ?></p>

        <div style="display: none;" id="comments">
            <div id="showcomment">

            </div>


            <div class="comment-section">
                <form method="post" id="commentinsert">
                    <h2>
                    Les commentaires</h2>
                    <textarea id="discomment" class="comment-textarea" required name="comments" placeholder="Écrivez votre commentaire ici..."></textarea>
                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $postid; ?>">
                    <?php
                    if (empty($_SESSION['user'])) {
                    ?>
                    <script>
                         document.getElementById("discomment").disabled = true;
                    </script>
                     <a href="./login.php"><button type="button" class="submit-btn">Connectez-vous pour commenter</button></a>
                    <?php
                    } else {
                    ?>
                        <button type="submit" class="submit-btn">
                            Publier un commentaire</button>
                    <?php
                    }
                    ?>

                </form>

            </div>
        </div>
    </div>


    <?php
    include('./include/sidebar.php');
    ?>
    <script>
        // Fonction JS pour basculer la visibilité des commentaires
        function toggleComments() {
            const commentsSection = document.getElementById("comments");

            // Basculez la propriété d'affichage entre 'aucun' et 'bloc'
            if (commentsSection.style.display === "none" || commentsSection.style.display === "") {
                commentsSection.style.display = "block"; 
                $("#showandhide").html("Cacher");
            } else {
                commentsSection.style.display = "none"; 
                $("#showandhide").html("Voir les commentaires");
            }
        }
    </script>
    <script>
        function loadcomments() {
            var post_id = $("#post_id").val();

            $.ajax({
                url: "../controller/loadcomment.php",
                method: "POST",
                data: {
                    postid: post_id
                },
                success: function(res) {
                    $("#showcomment").html(res);
                }

            })
        }
        loadcomments();
        $(document).ready(function() {

            $('#commentinsert').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(commentinsert);

                $.ajax({
                    url: "../controller/comments.php",
                    method: "POST",
                    data: mydata,
                    processData: false,
                    contentType: false,
                    success: function(res) {

                        if (res == 1) {

                            sessionStorage.setItem("commentmsg", "Veuillez vous connecter pour commenter.");
                            setTimeout(() => {
                                window.location.href = "./login.php";
                            }, 1000);
                        } else if (res == 2) {
                            $("#commentinsert").trigger("reset");
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "success",
                                title: "Votre commentaire a été posté avec succès!"
                            });

                            loadcomments();
                        } else if (res == 3) {
                            const Toast = Swal.mixin({
                                toast: true,
                                position: "top-end",
                                showConfirmButton: false,
                                timer: 3000,
                                timerProgressBar: true,
                                didOpen: (toast) => {
                                    toast.onmouseenter = Swal.stopTimer;
                                    toast.onmouseleave = Swal.resumeTimer;
                                }
                            });
                            Toast.fire({
                                icon: "error",
                                title: "Votre commentaire n'a pas été publié"
                            });


                        }
                    }
                })
            })
        })
    </script>