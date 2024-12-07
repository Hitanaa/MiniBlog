<?php
session_start();
include('./include/header.php');
?>

<!-- Conteneur de contenu principal -->
<div class="container-profile">
    <div class="post-profile">
        <div class="inner-border-profile">

            <h1>Se connecter</h1>
            <p>Nouveau sur ce site? <a href="./register.php">S'inscrire</a></p>
            <!-- Formulaire de connexion -->
            <form id="loginForm" method="POST">
                <div class="form-group">
                    <label for="useremail">E-mail</label>
                    <input type="email" id="useremail" name="useremail" placeholder="Entrez l'e-mail" required>
                </div>
                <div class="form-group">
                    <label for="userpassword">Mot de passe</label>
                    <input type="password" id="userpassword" name="userpassword" placeholder="Entrez le mot de passe" required>
                </div>
                <div class="button-container">
                    <input type="submit" id="loginbtn" class="connexion" value="Se connecter" name="submit">

                </div>
            </form>
        </div>
    </div>


    <?php
    include('./include/sidebar.php');
    ?>
    <script>
    let commentmsg = sessionStorage.getItem("commentmsg");
   
    if (commentmsg != null) {
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
            title: commentmsg
        });

      sessionStorage.clear();
    }
</script>
    <script>
        $(document).ready(function() {

            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(loginForm);

                $.ajax({
                    url: "../controller/loginuser.php",
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
                                title: "Email or password is wrong"
                            });

                        } else if (res == 3) {
                            // Récupère l'élément bouton
                            let button = document.getElementById("loginbtn");

                             // Désactive le bouton
                            button.disabled = true;
                            $("#loginForm").trigger("reset");
                            sessionStorage.setItem("loginmsg", "L'administrateur s'est connecté");
                            setTimeout(() => {
                                window.location.href = "../../admin/index.php";
                            }, 1000);


                        } else if (res == 4) {
                            // Récupère l'élément bouton
                            let button = document.getElementById("loginbtn");

                            // Désactive le bouton
                            button.disabled = true;
                            sessionStorage.setItem("loginmsg", "L'utilisateur s'est connecté");
                            setTimeout(() => {
                                window.location.href = "../index.php";
                            }, 1000);


                            $("#loginForm").trigger("reset");

                        }
                    }
                })
            })
        })
    </script>