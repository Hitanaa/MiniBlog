<?php
include("../../blog/controller/connection.php");
include("./include/headersidebar.php");
?>


<!-- Début table -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Commentaires</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Photos</th>
                                <th>Nom de l'auteur</th>
                                <th>Titres</th>
                                <th>Commentaires</th>
                                <th>Dates</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $obj = new Database();
                            $sql = $obj->select('comments', '*', null, "INNER JOIN `users` ON comments.commentuser=users.useremail INNER JOIN `post` ON comments.post_id=post.postid");
                            if (empty($sql[0])) {
                            ?>
                                <tr align="center">
                                    <td colspan="6"> Pas de commentaires </td>
                                </tr>
                                <?php
                            } else {
                                foreach ($sql as $fet) {
                                ?>
                                    <tr>
                                        <td><?php
                                            if (!empty($fet['userpic'])) {
                                            ?>
                                                <img width="70" height="70" src="<?php echo "../../blog/user_pic/" . $fet['userpic'] ?>" alt="">
                                            <?php
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo $fet['username']; ?></td>
                                        <td><?php echo $fet['posttitle']; ?></td>
                                        <td><?php echo $fet['comments']; ?></td>
                                        <td><?php echo $fet['commentdate']; ?></td>


                                        <td><button data-commentid="<?php echo $fet['commentid']; ?>" class="btn delete" style="background-color:#9e2b25;color:white">Supprimer</button></td>

                                    </tr>
                            <?php

                                }
                            }
                            ?>



                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin table -->

<?php
include('./include/footer.php');
?>
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            var del = $(this).data("commentid");
            Swal.fire({
                title: "Es-tu sûr?",
                text: "Vous ne pourrez pas revenir en arrière !",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Supprimer"
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: "./deletecomment.php",
                        method: "GET",
                        data: {
                            "commentid": del
                        },
                        success: function(res) {

                            if (res == 1) {
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
                                    title: "Le commentaire a été supprimé"
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 2000);

                            }
                        }
                    });
                }
            });
        });

    });
</script>