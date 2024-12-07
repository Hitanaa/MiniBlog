<?php 
include("../../blog/controller/connection.php");
$postid=$_GET['postid'];
$obj = new Database();
$fet = $obj->select('post', '*', "`postid`='$postid'");

  include('./include/headersidebar.php');
?>


            <!-- Début formulaire -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Mettre à jour le billet</h6>
                            <form id="updatepost"  enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="posttitle" class="form-label">Titre</label>
                                    <input type="text" value="<?php echo $fet[0]['posttitle']; ?>" required class="form-control" id="posttitle" name="posttitle">
                                    <input type="hidden" value="<?php echo $fet[0]['postid']; ?>" required class="form-control" id="postid" name="postid">
                                
                                </div>
                                <div class="mb-3">
                                    <label for="postcontent" class="form-label">Contenu</label>
                                    <textarea name="postcontent" id="postcontent" required class="form-control"><?php echo $fet[0]['postcontent']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="postimage" class="form-label">Publier une image</label>
                                    <input type="file" accept=".png, .jpg, .jpeg" class="form-control" id="postimage" name="postimage">
                                </div>
                          
                                  <input type="submit" value="Modifier" name="submit" style="background-color:#9e2b25;color:white" class="btn">
                                
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

            $('#updatepost').on('submit', function(e) {
                e.preventDefault();
                var mydata = new FormData(updatepost);
              
                $.ajax({
                    url: "../controller/post/postupdate.php",
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
                                title: "Veuillez remplir tous les champs."
                            });
                        }  else if (res == 3) {
                      
                            $("#updatepost").trigger("reset");
                            sessionStorage.setItem("updatepost", "Le message a été mis à jour");
                            setTimeout(() => {
                                window.location.href = "./viewpost.php";
                            }, 1000);
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
                                title: "Le message n'a pas été mis à jour"
                            });

                        }
                    }
                })
            })
        })
    </script>