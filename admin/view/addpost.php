<?php 
  include('./include/headersidebar.php');
?>


            <!-- Début formulaire -->
            <div class="container-fluid pt-4 px-4">
                <div class="row g-4 justify-content-center">
                    <div class="col-sm-12 col-xl-6">
                        <div class="bg-light rounded h-100 p-4">
                            <h6 class="mb-4">Ajouter un billet</h6>
                            <form id="addpost" method="post" enctype="multipart/form-data">
                                <div class="mb-3">
                                    <label for="posttitle" class="form-label">Titre</label>
                                    <input type="text" required class="form-control" placeholder="Titre du message" id="posttitle" name="posttitle">
                                
                                </div>
                                <div class="mb-3">
                                    <label for="postcontent" class="form-label">Contenu</label>
                                    <textarea name="postcontent" placeholder="Publier du contenu" id="postcontent" required class="form-control"></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="postimage" class="form-label">Publier une image</label>
                                    <input type="file" accept=".png, .jpg, .jpeg" required class="form-control" id="postimage" name="postimage">
                                </div>
                          
                                  <input id="subbtn" type="submit" value="Ajouter" name="submit" style="background-color:#9e2b25;color:white" class="btn">
                                
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

            $('#addpost').on('submit', function(e) {
                e.preventDefault();
            document.getElementById("subbtn").disabled = true;
                var mydata = new FormData(addpost);
              
                $.ajax({
                    url: "../controller/post/postinsert.php",
                    method: "POST",
                    data: mydata,
                    processData: false,
                    contentType: false,
                    success: function(res) {
                       
                        if (res == 1) {
                            document.getElementById("subbtn").disabled = false;
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
                        } else if (res == 2) {
                            document.getElementById("subbtn").disabled = false;
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
                                title: "Vous ne pouvez sélectionner que des images aux formats PNG, JPEG ou JPG."
                            });

                        } else if (res == 3) {
                           
                            $("#addpost").trigger("reset");
                            document.getElementById("subbtn").disabled = false;
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
                                title: "Le billet à été ajouté"
                            });
                          
                      
                        } else if (res == 4) {
                            document.getElementById("subbtn").disabled = false;
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
                                title: "Le message n'a pas été inséré"
                            });

                        }
                    }
                })
            })
        })
    </script>