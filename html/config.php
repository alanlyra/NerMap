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
            <h1 class="h3 mb-0 text-gray-800"><?php echo $LANG['36']; ?></h1>
          </div>

          <!-- Content Row -->
          <div class="row">

          <?php
          $search_admin=get_data("SELECT * FROM users WHERE id_user = " .intval($_SESSION["id"]) . " AND admin = 'true'");
          $results_max_admin = pg_num_rows($search_admin);

          if($results_max_admin > 0) {
            echo "<div class='col-xl-8 col-lg-9'>
                    <div class='card shadow mb-4'>
                      <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-primary'>Aprimorar modelo de treino</h6>
                      </div>
                      </br>
                      <div class='col-xl-4 col-lg-5'>
                        <a href='#' class='d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm'><i class='fas fa-download fa-sm text-white-50'></i> Carregar Relatório</a>
                        </br></br>
                        <label class='container'>Conll
                          <input type='radio' checked='checked' name='radio'>
                          <span class='checkmark'></span>
                        </label>
                        <label class='container'>Texto
                          <input type='radio' name='radio'>
                          <span class='checkmark'></span>
                        </label>
                      </div>
                      </br>
                      <div class='col-xl-4 col-lg-5'>
                        <input type='text' class='form-control bg-light border-0 small' placeholder='Nome do Roadmap...' aria-label='Search' aria-describedby='basic-addon2'>
                      </div>
                      </br>
                      <div class='col-xl-4 col-lg-5'>
                        <input type='text' class='form-control bg-light border-0 small' placeholder='Tema da Prospecção...' aria-label='Search' aria-describedby='basic-addon2'>
                      </div>
                      </br>
                      <a href='#' class='btn btn-primary btn-icon-split' style='width:8em;'>

                          <span class='text'>Iniciar</span>
                      </a>
                      </br>
                    </div>
                  </div>";
          }
          else {
            echo "<div id='main-content' class='col-xl-12 col-lg-12' style='height: 77vh;'>".$LANG['177']."</div>";
          }

          ?>
            
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

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function load(){
      document.getElementById("li_config").classList.add('active');
    }
  </script>

</body>

</html>
