<?php
include("../../blog/controller/connection.php");
include("./include/headersidebar.php");
?>


<!-- Début table -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">

        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
            <a class="btn float-end mt-0" style="background-color:#9e2b25;color:white" href="./addpost.php">Ajouter un billet</a>
                <h6 class="mb-4">Billets</h6>
               
                <div class="table-responsive ">
                    <table class="table mt-4">
                        <thead>
                            <tr>
                                <th>Titres</th>
                                <th>Contenus</th>
                                <th>Images</th>
                                <th>Date de publication</th>
                                <th>Auteur</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                           $obj = new Database();
                           $res = $obj->select('post', '*', null, null, null, null);
                            foreach($res as $fet) {
                              
                            ?>
                                <tr>
                                    
                                    <td><?php echo $fet['posttitle']; ?></td>
                                    <td>
                                        <?php 
                                        echo $fet['postcontent']; 
                                        ?>
                                    </td>
                                    <td><img width="100" height="100" src="<?php echo '../../blog/postimage/'.$fet['postimage']; ?>" alt=""></td>
                                    <td><?php echo $fet['postdate']; ?></td>
                                    <td><?php echo $fet['postauthor']; ?></td>
                                    <td><a class="btn" style="background-color:#9e2b25;color:white" href="./updatepost.php?postid=<?php echo $fet['postid']; ?>">Modifier</a></td>
                                    <td>
                                    <button data-postid="<?php echo $fet['postid']; ?>" class="btn delete" style="background-color:#9e2b25;color:white">Supprimer</button></td>
                                    
                                </tr>
                            <?php
                                
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
    let updatepost = sessionStorage.getItem("updatepost");
   
    if (updatepost != null) {
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
            title: "Le message a été mis à jour"
        });

      sessionStorage.clear();
    }
</script>
<script>
    $(document).ready(function() {
        $(document).on("click", ".delete", function(e) {
            e.preventDefault();
            var del = $(this).data("postid");
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
                        url: "./deletepost.php",
                        method: "GET",
                        data: {
                            "postid": del
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
                                    title: "Le billet a été supprimé"
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