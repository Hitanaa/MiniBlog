<?php
session_start();
if (empty($_SESSION['admin'])) {
    header("Location:../../blog/view/login.php");
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <title>BLOG - EVE GONCALVES</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-fluid position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Chargement...</span>
            </div>
        </div>
        <!-- Spinner End -->

        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar  navbar-light">
                <a href="../../blog/index.php" class="navbar-brand mx-4 mb-3">
                    <h3 style="color:#eae0d5;"><img width="60" src="../img/icon.png" alt=""></h3>
                </a>

                <div class="navbar-nav w-100">
                    <a href="../index.php" class="nav-item nav-link active"><i
                            class="fa fa-tachometer-alt me-2" style="color:black;"></i>Tableau de bord</a>
                    <a href="viewuser.php" class="nav-item nav-link"><i class="fa fa-th me-2" style="color:black;"></i>Utilisateurs</a>
                    <a href="./viewpost.php" class="nav-item nav-link"><i class="fas fa-eye me-2" style="color:black;"></i>Billets</a>
                    <a href="./viewcomment.php" class="nav-item nav-link"><i class="fas fa-comments me-2" style="color:black;"></i>Commentaires</a>


                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand  navbar-light sticky-top px-4 py-0" style="background-color: #9e2b25;">
                <a href="../index.php" class="navbar-brand d-flex d-lg-none me-4">
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
                            <img class="rounded-circle me-lg-2" src="../img/user.jpg" alt=""
                                style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">Administrateur</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">

                            <a href="./logout.php" class="dropdown-item">Se déconnecter</a>
                        </div>
                    </div>
                </div>
            </nav>