<?php
session_start();
include('./controller/connection.php');
$obj = new Database(); 
$fet = $obj->select("post", "*", null, "INNER JOIN users ON post.postauthor=users.useremail", null, "postid DESC", 3);

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BLOG - EVE GONCALVES</title>
    <link rel="stylesheet" href="styles.css">

        <!-- Favicon -->
        <link href="img/favicon.png" rel="icon">
        
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>


<body>
    <!-- Logo en haut à droite -->
    <a href="./index.php"><img src="img/icon.png" alt="Logo" class="logo"></a>


   <!-- Conteneur de contenu principal -->
    <div class="container">
        <?php
        $a = 1;
        foreach ($fet as $postdata) {
            if ($a == 2) {
                $style = "style='left: -14%; top: 150px;'";
            }
        ?>
            <div class="post" <?php echo @$style; ?>>
                <div class="inner-border">
                    <img class="postpic" src="<?php echo "./postimage/" . $postdata['postimage']; ?>" alt="">
                    <a href="./view/view-more.php?postid=<?php echo $postdata['postid'] ?>" style="text-decoration: none;"
                        class="view-more">Voir plus</a>
                    <div class="post-date"><span
                            style="float:right"><?php echo $postdata['username']; ?></span><br><?php echo $postdata['postdate']; ?>
                    </div>
                </div>
            </div>
        <?php
            $style = "";
            $a++;
        }
        ?>

    </div>

    <!-- Sidebar -->
    <div class="sidebar">
        <a href="./view/archive.php"><button><img src="img/archive.png" alt="archive"></button></a>
        <a href="./index.php"><button><img src="img/home.png" alt="home"></button></a>
        <?php
        if (!empty($_SESSION['user'])) {
        ?>
            <a href="./view/profile.php"><button><img src="./img/profile-barre.png" alt="profile"></button></a>

            <a href="../admin/view/logout.php"><button><i class="fa-solid fa-right-from-bracket"
                        style="font-size: 30px; color:#9e2b25;"></i></button></a>
        <?php
        } elseif (!empty($_SESSION['admin'])) {
        ?>
            <a href="../admin/index.php"><button><img src="./img/profile-barre.png" alt="profile"></button></a>
        <?php
        } else {
        ?>
            <a href="./view/login.php"><button><i class="fa-solid fa-user"
                        style="font-size: 30px; color:#9e2b25;"></i></button></a>

        <?php
        }
        ?>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('profileImage').src = e.target.result;
                };
                reader.readAsDataURL(file);
            }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
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