<?php
include("../../blog/controller/connection.php");
include("./include/headersidebar.php");
?>


<!-- Début table -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Tableau utilisateur</h6>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>

                                <th>Nom d'utilisateur</th>
                                <th>E-mail</th>
                                <th>Photo de profil</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $obj = new Database();
                            $res = $obj->select('users', '*', null, null, null, null);
                            foreach ($res as $fet) {
                                if ($fet['userstatus'] == "user") {
                            ?>
                                    <tr>
                                        <td><?php echo $fet['username']; ?></td>
                                        <td><?php echo $fet['useremail']; ?></td>
                                        <td><?php 
                                                 if(!empty($fet['userpic'])){
                                                     ?>
                                                    <img width="70" height="50"  src="<?php echo "../../blog/user_pic/".$fet['userpic'] ?>" alt="">
                                                     <?php
                                                 }
                                         ?></td>
                                        <td><a class="btn" style="background-color:#9e2b25;color:white" href="./updateuser.php?userid=<?php echo $fet['usersid']; ?>">Modifier</a></td>
                                        <td>
                                        <button data-userid="<?php echo $fet['usersid']; ?>" class="btn delete" style="background-color:#9e2b25;color:white">Supprimer</button></td>
                                    

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
    let updateuser = sessionStorage.getItem("updateuser");
   
    if (updateuser != null) {
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
            title: "L'utilisateur a été modifier"
        });

      sessionStorage.clear();
    }
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            var del = $(this).data("userid");
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
                        url: "./deleteuser.php",
                        method: "GET",
                        data: {
                            "userid": del
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
                                    title: "L'utilisateur a été supprimé"
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