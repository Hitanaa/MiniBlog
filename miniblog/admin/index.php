<?php
include("../blog/controller/connection.php");
session_start();
if (empty($_SESSION['admin'])) {
    header("Location:../blog/view/login.php");
}
$obj = new Database();
$users = $obj->select('users', '*', '`userstatus`="user"', null, null, null);
$posts = $obj->select('post', '*', null, null, null, null);
$comments = $obj->select('comments', '*', null, null, null, null);
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>BLOG - EVE GONCALVES</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.png" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">

        <!-- Démarrage du chargement -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
        <!-- Fin de chargement -->

        <!-- Tableau de bord -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar  navbar-light">
                <a href="../blog/index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color:#eae0d5;"><img width="60" src="./img/icon.png" alt=""></h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="./index.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2"></i>Tableau de bord</a>
                    <a href="./view/viewuser.php" class="nav-item nav-link"><i class="fa fa-th me-2" style="color:black;"></i>Utilisateurs</a>
                    <a href="./view/viewpost.php" class="nav-item nav-link"><i class="fas fa-eye me-2" style="color:black;"></i>Billets</a>
                    <a href="./view/viewcomment.php" class="nav-item nav-link"><i class="fas fa-comments me-2" style="color:black;"></i>
                        Commentaires</a>



                </div>
            </nav>
        </div>
        <!-- Fin du Tableau de bord -->


        <!-- Début du contenu -->
        <div class="content">

            <!-- Navbar -->
            <nav class="navbar navbar-expand  navbar-light sticky-top px-4 py-0" style="background-color: #9e2b25;">
                <a href="./index.php" class="navbar-brand d-flex d-lg-none me-4">
                    <h3 style="color:#eae0d5;"><img width="60" src="../img/icon.png" alt=""></h3>
                </a>

                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="fa fa-bars" style="color:#9e2b25;"></i>
                </a>
                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">


                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="./img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Administrateur</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <a href="./view/logout.php" class="dropdown-item">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </nav>

            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <h1 class="text-center mt-5" style="color:#9e2b25;">TABLEAU DE BORD</h1>
                    </div>
                </div>
            </div>

            <div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-4">
                        <a href="./view/viewuser.php" style="color:black;">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fa-solid fa-users" style="font-size: 35px; color:#9e2b25"></i>
                                <div class="ms-3">
                                    <p class="mb-2" style="color:#9e2b25;">Nombre d'utilisateurs</p>
                                    <h6 class="mb-0" style="color:#9e2b25;"><?php echo count($users) ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-6 col-xl-4">
                        <a href="./view/viewpost.php" style="color:black;">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fas fa-newspaper" style="font-size: 35px; color:#9e2b25"></i>
                                <div class="ms-3">
                                    <p class="mb-2" style="color:#9e2b25;">Nombre de billets</p>
                                    <h6 class="mb-0" style="color:#9e2b25;"><?php echo count($posts) ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-6 col-xl-4">
                        <a href="./view/viewcomment.php" style="color: black;">
                            <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                                <i class="fas fa-comments" style="font-size: 35px; color:#9e2b25"></i>
                                <div class="ms-3">
                                    <p class="mb-2" style="color:#9e2b25;">Nombre de commentaires</p>
                                    <h6 class="mb-0" style="color:#9e2b25;"><?php echo count($comments) ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </div>
        </div>
        <!-- Fin du contenu -->

        <!-- 
        - Fonction pour montrer le message
        - Alertes (succès ou échec) -->
        <script>
            function showMessage(message, type = 'success') {
                const alertBox = document.getElementById('alertMessage');

                alertBox.className = `alert alert-${type} alert-dismissible fade show`;
                alertBox.innerHTML = `<strong>${type === 'success' ? 'Success!' : 'Error!'}</strong> ${message}`;
                alertBox.style.display = 'block';

                setTimeout(() => {
                    alertBox.style.display = 'none';
                }, 3000);
            }
        </script>

        <!-- Revenir en haut -->
        <a href="#" class="btn btn-lg  btn-lg-square back-to-top" style="background-color:#9e2b25;color:white"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        let loginmsg = sessionStorage.getItem("loginmsg");

        if (loginmsg != null) {
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
                title: loginmsg
            });

            sessionStorage.clear();
        }
    </script>
</body>

</html>