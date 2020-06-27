<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once("head.php") ?>

<body id="page-top" onload="load();">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <?php include_once("menulateral.php") ?>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <?php include_once("menusuperior.php") ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800"><?php echo $LANG['13']; ?></h1>
          </div>

          <!-- Content Row -->

          <div class="row justify-content-center">

            <!-- Project Card Example -->
            <div class="col-xl-11 col-lg-10">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary"><?php echo $LANG['170']; ?></h6>
                </div>

                <form action="config-usuario.php" method="post" multipart="" enctype="multipart/form-data">

                <div class="avatar-upload">
                    <div class="avatar-edit">
                        <input type='file' id="imageUpload"  name="imageUpload" accept=".png, .jpg, .jpeg" />
                        <label for="imageUpload"><img src="img/editar7.png" alt="Editar Foto" height="15px" width="15px" style="margin-left:8.5px; margin-top:8px; opacity: 70%;"></label>
                    </div>
                    <div class="avatar-preview">
                        <div id="imagePreview" style="background-image: url(<?php echo $_SESSION['photo']?>);">
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center">
                <div class="col-xl-5 col-lg-5 feature-box" style="float: left; margin: 0 1rem 2rem 0; text-align: left;">
                  <div class="col-xl-12 col-lg-12">
                   <h5><?php echo $LANG['3']; ?>:</h5>
                    <input type="text" id="nomeUsuario" name="nomeUsuario" class="form-control bg-light border-0 small" value="<?php echo $_SESSION['name']?>" aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  </br>
                  <div class="col-xl-12 col-lg-12">
                    <h5><?php echo $LANG['96']; ?>:</h5>
                      <input type="text" id="emailUsuario" name="emailUsuario" class="form-control bg-light border-0 small" value="<?php echo $_SESSION['email']?>" aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  </br>
                  </br>
                  <div class="py-3" style="text-align: center;">
                    <input class="btn btn-primary btn-icon-split" type="submit" name="salvarEdicaoUsuario" value="<?php echo $LANG['173']; ?>" style="width: 11rem; height: 2em; display: inline-block;" />
                  </div>
                </div>
                </form>
               

                
                <div class="col-xl-5 col-lg-5 feature-box" style="float: left; margin: 0 0 2rem 1rem; text-align: left;">
                <div id="messageSenhaIncorreta" style="display: none;" class="alert alert-warning ">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                  </button> <?php echo $LANG['175']; ?>
                </div>
                <div id="messageSenhaAlterada" style="display: none;" class="alert alert-success ">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                  </button> <?php echo $LANG['176']; ?>
                </div>
                <form action="config-usuario.php" method="post" multipart="" enctype="multipart/form-data">
              		<div class="col-xl-12 col-lg-12">
              		<h5><?php echo $LANG['171']; ?>:</h5>
                    <input type="password" id="senhaAntiga" name="senhaAntiga" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  </br>
                  <div class="col-xl-12 col-lg-12">
              		<h5><?php echo $LANG['172']; ?>:</h5>
                    <input type="password" id="novaSenha" name="novaSenha" class="form-control bg-light border-0 small" aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  </br>
                  </br>
                  <div class="py-3" style="text-align: center;">
                    <input class="btn btn-primary btn-icon-split" type="submit" name="salvarTrocaSenhaUsuario" value="<?php echo $LANG['174']; ?>" style="width: 9em; height: 2em; display: inline-block;" />
                  </div>
                  </form>
                </div>
                
                </div>

                </div>
                        
              </div>

            </div>
    
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Footer -->
      <?php include_once("footer.php") ?>
      <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

  </div>
  <!-- End of Page Wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

 <!-- Logout Modal-->
 <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><?php echo $LANG['168']; ?></h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body"><?php echo $LANG['169']; ?></div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal"><?php echo $LANG['106']; ?></button>
          <a class="btn btn-primary" href="login.php?action=logout"><?php echo $LANG['112']; ?></a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function load(){
      document.getElementById("li_config_user").classList.add('active');
    }

    function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();
          reader.onload = function(e) {
              $('#imagePreview').css('background-image', 'url('+e.target.result +')');
              $('#imagePreview').hide();
              $('#imagePreview').fadeIn(650);
          }
          reader.readAsDataURL(input.files[0]);
      }
    }

    $("#imageUpload").change(function() {
        readURL(this);
    });

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<?php
	//echo '<pre>';

  if(isset($_POST["salvarEdicaoUsuario"])) {

  	$nome = $_POST['nomeUsuario'];
  	$email = $_POST['emailUsuario'];
  	$image = $_POST['imageUpload'];

  	if(!$nome == "" && !$email == "") {   	
        $id_user = $_SESSION['id'];

        $file_size=$_FILES['imageUpload']['size'];
        $file_tmp= $_FILES['imageUpload']['tmp_name'];

        $type = pathinfo($file_tmp, PATHINFO_EXTENSION);
        $data = file_get_contents($file_tmp);
        $base64 = "data:image/" . $type . ";base64," . base64_encode($data);

        if(base64_encode($data) == "")
          db_user($id_user, $nome, $email);
        else
          db_user_with_new_photo($id_user, $nome, $email, $base64);
  	}
  	else{
      //echo "<script> document.getElementById('messageCampos').style.display = 'block'; </script>";
  		//echo "<script>console.log( 'Deu ruim!' );</script>";
  	}

  }

	function db_user($id_user_db, $nome_db, $email_db) {
        $update_on_user = set_data("UPDATE users SET name_user = $1, email = $2 where id_user = $3", array($nome_db, $email_db, $id_user_db));
        $_SESSION['name'] = $nome_db;
        $_SESSION['email'] = $email_db;
        echo "<script>window.location.href = 'config-usuario.php';</script>";
    }

    function db_user_with_new_photo($id_user_db, $nome_db, $email_db, $photo_db) {
      $update_on_user = set_data("UPDATE users SET name_user = $1, email = $2, photo = $3 where id_user = $4", array($nome_db, $email_db, $photo_db, $id_user_db));
      $_SESSION['name'] = $nome_db;
      $_SESSION['email'] = $email_db;
      $_SESSION['photo'] = $photo_db;
      echo "<script>window.location.href = 'config-usuario.php';</script>";
  }


    if(isset($_POST["salvarTrocaSenhaUsuario"])) {

      $senha_antiga = $_POST['senhaAntiga'];
      $senha_nova = $_POST['novaSenha'];
  
      if(!$senha_antiga == "" && !$senha_nova == "") {   	
          $id_user = $_SESSION['id'];

          $number2 = get_data("SELECT password FROM users WHERE id_user =".intval($id_user));
          $row1 = pg_fetch_array($number2);        
          $senha_user = $row1[0];

          if(md5($senha_antiga) == $senha_user){
            db_user_trocar_senha($id_user, md5($senha_nova));
          }
          else {
            echo "<script> document.getElementById('messageSenhaIncorreta').style.display = 'block'; </script>";
          }
 
      }
      else{
      }
  
    }
  
    function db_user_trocar_senha($id_user_db, $senha_nova_db) {
          $update_on_user = set_data("UPDATE users SET password = $1 where id_user = $2", array($senha_nova_db, $id_user_db));
          echo "<script> document.getElementById('messageSenhaAlterada').style.display = 'block'; </script>";
          echo "<script>window.location.href = 'config-usuario.php';</script>";
      }

?>