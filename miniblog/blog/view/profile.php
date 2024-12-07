<?php
session_start();
if (empty($_SESSION['user'])) {
    header("Location:./login.php");
}
$email=$_SESSION['user'];
include("../controller/connection.php");
$obj = new Database();
$fet = $obj->select('users', '*', "`useremail`='$email'");
include('./include/header.php');
?>

    <!-- Conteneur de contenu principal -->
    <div class="container-profile">
    <form id="profiledata" method="POST" enctype="multipart/form-data">
        <div class="post-profile">
            <div class="inner-border-profile">
                <div class="profile-picture-circle">
                <?php 
                   if(!empty($fet[0]['userpic'])){
                    ?>
                     <img id="profileImage" src="<?php echo "../user_pic/".$fet[0]['userpic']; ?>" alt=".">
                    
                    <?php
                   }else{
                    ?>
                      <img id="profileImage" src="img/default-profile.png" alt=".">
                    <?php
                   }
                ?>
                   
                    <input type="file" name="userpic" id="fileInput" accept="image/*" onchange="previewImage(event)">

                </div>
                <img src="../img/modifier.png" alt="Modifier" class="edit-icon"> <!-- Icône de modification -->
       
              


                <!-- Formulaire de connexion -->
                 
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" readonly value="<?php echo $fet[0]['useremail']; ?>" id="email" name="useremail" placeholder="Entrez l'e-mail" required>
                    <input type="hidden" readonly value="<?php echo $fet[0]['usersid']; ?>" name="usersid" required>
                </div>
                <div class="form-group">
                    <label for="username">Identifiant</label>
                    <input type="text" id="username" placeholder="Entrez le nom d'utilisateu" value="<?php echo $fet[0]['username']; ?>" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" placeholder="Entrez le mot de passe" name="userpassword">
                </div>
                <div class="button-container">
                    <button class="deconnexion" type="submit">Confirmer</button>
                </div>

            </div>
            </form>
        </div>


<?php
include('./include/sidebar.php');
?>
   <script>
        $(document).ready(function() {

            $('#profiledata').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(profiledata);

                $.ajax({
                    url: "../controller/updateuser.php",
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
                                icon: "error",
                                title: "Veuillez remplir tous les champs."
                            });
                        } else if (res == 2) {
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
                               title: "L'utilisateur a été mis à jour"
                            });

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
                                title: "L'utilisateur n'a pas été mis à jour"
                            });
                            $("#profiledata").trigger("reset");
                            setTimeout(() => {
                                window.location.href = "./login.php";
                            }, 3000);
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