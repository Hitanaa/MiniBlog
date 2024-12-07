<?php
session_start();
include('./include/header.php');
?>

<!-- Conteneur de contenu principal -->
<div class="container-profile">
    <div class="post-profile">
        <div class="inner-border-profile">

            <h1>S'inscrire</h1>
            <p>Vous avez déjà un compte ? <a href="./login.php">Se connecter</a></p>
            <!-- Formulaire de connexion -->
            <form id="registerForm" method="POST">
                <div class="form-group">
                    <label for="email">E-mail</label>
                    <input type="email" id="email" placeholder="Entrez l'e-mail" name="useremail" required>
                </div>
                <div class="form-group">
                    <label for="username">Identifiant</label>
                    <input type="text" id="username" placeholder="Entrez le nom d'utilisateur" name="username" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" placeholder="Entrez le mot de passe" name="userpassword" required>
                </div>
                <div class="button-container">
                    <input type="submit" value="S'inscrire" class="inscription" name="submit" />

                </div>
            </form>
        </div>
    </div>

    <?php
    include('./include/sidebar.php');
    ?>
    <script>
        $(document).ready(function() {

            $('#registerForm').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(registerForm);

                $.ajax({
                    url: "../controller/registerinsert.php",
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
                                icon: "error",
                                title: "L'e-mail existe déjà"
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
                                icon: "success",
                                title: "L'utilisateur a été enregistré"
                            });
                            $("#registerForm").trigger("reset");
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
                                icon: "error",
                                title: "L'utilisateur n'a pas été enregistré"
                            });

                        }
                    }
                })
            })
        })
    </script>