<?php
include("../../blog/controller/connection.php");
$usersid=$_GET['userid'];
$obj = new Database();
$fet = $obj->select('users', '*', "`usersid`='$usersid'");
include('./include/headersidebar.php');
?>


<!-- Début formulaire -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4 justify-content-center">
        <div class="col-sm-12 col-xl-6">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Modifier l'utilisateur</h6>
                <form id="updateuser"  method="post">
                    <div class="mb-3">
                        <label for="useremail" class="form-label">E-mail</label>
                        <input required type="email" value="<?php echo $fet[0]['useremail'];  ?>" class="form-control" name="useremail" id="useremail">
                        <input required type="hidden" value="<?php echo $fet[0]['usersid'];  ?>" class="form-control" name="usersid" >
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Identifiant</label>
                        <input required type="text" class="form-control" value="<?php echo $fet[0]['username'];  ?>" name="username" id="username">
                    </div>
            
                    <div class="mb-3">
                        <label for="userpassword" class="form-label">Mot de passe</label>
                        <input  type="password" class="form-control" name="userpassword" id="userpassword">
                    </div>
                    <div class="mb-3">
                        <label for="userpic" class="form-label">Photo de profil</label>
                        <input  type="file" accept="image/*"  class="form-control" name="userpic" id="userpic">
                    </div>
                    <div class="mb-3">
                        <label for="userstatus" class="form-label">Statut</label>
                        <input required type="text" readonly value="<?php echo $fet[0]['userstatus'];  ?>" class="form-control" name="userstatus" id="userstatus">
                    </div>
                 
                    <input type="submit" name="submit" value="Modifier" style="background-color:#9e2b25;color:white" class="btn">

                </form>
            </div>
        </div>





    </div>
</div>
<!-- Fin formulaire -->



<?php
include('./include/footer.php')
?>
   <script>
        $(document).ready(function() {

            $('#updateuser').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(updateuser);

                $.ajax({
                    url: "../controller/user/userupdate.php",
                    method: "POST",
                    data: mydata,
                    processData: false,
                    contentType: false,
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
                                icon: "Error",
                                title: "Plz Fill All Fields."
                            });
                        } else if (res == 2) {
                   
                            $("#updateuser").trigger("reset");
                            sessionStorage.setItem("updateuser", "L'utilisateur a été mis à jour");
                            setTimeout(() => {
                                window.location.href = "./viewuser.php";
                            }, 1000);
                            
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
                                icon: "Error",
                                title: "L'utilisateur n'a pas été mis à jour"
                            });
                           
                        } else if (res == 4) {
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
                                icon: "Error",
                                title: "le téléchargement du fichier a échoué"
                            });

                        }
                    }
                })
            })
        })
    </script>