        <!-- Sidebar -->
        <div class="sidebar">
            <a href="./archive.php"><button><img src="../img/archive.png" alt="archive"></button></a>
            <a href="../index.php"><button><img src="../img/home.png" alt="home"></button></a>
            <?php
        if (!empty($_SESSION['user'])) {
        ?>
            <a href="./profile.php"><button><img src="../img/profile-barre.png" alt="profile"></button></a>

            <a href="../../admin/view/logout.php"><button><i class="fa-solid fa-right-from-bracket"
                        style="font-size: 30px; color:#9e2b25;"></i></button></a>
        <?php
        } elseif (!empty($_SESSION['admin'])) {
        ?>
            <a href="../../admin/index.php"><button><img src="../img/profile-barre.png" alt="profile"></button></a>
        <?php
        } else {
        ?>
            <a href="./login.php"><button><i class="fa-solid fa-user"
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
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   
</body>

</html>