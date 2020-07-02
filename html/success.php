<?php
require_once 'system.php';
require_once 'checklogin.php';
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

          <!-- Content Row -->

          <div class="row justify-content-center">

            <!-- Project Card Example -->
            <div class="col-xl-5 col-lg-4">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Mensagem</h6>
                </div>
                <div class="row text-center justify-content-center">
                  <div class="col-sm-6 col-sm-offset-3">
                        <br><br> <h2 style="color:#0fad00">Successo!</h2>
                        <img src="/img/success.png" style="width: 30px; height: 30px;">
                         <br><br>
                        <p style="font-size:20px;color:#5C5C5C;">
                        <?php
                          if(isset($_GET["action"])) {
                            $action = $_GET['action'];
                            $message = "";
                            $action_txt = "";
                            $action_page = "";

                            if($action == "trm-adicionado") {
                              $message = "O Technology Roadmapping foi criado com sucesso!";
                              $action_txt = "Gerenciar TRMs";
                              $action_page = "trms.php";
                            }
                            else if($action == "arquivo-adicionado") {
                              $message = "O arquivo foi adicionado com sucesso ao TRM!";
                              $action_txt = "Visualizar TRMs";
                              $action_page = "roadmaps.php";
                            }
                            else {
                              $message = "";
                            }

                            echo $message;
                            echo "</p>
                            <button class='btn btn-secondary' style='margin:5px;' onclick='goBack();'>Voltar</button>";

                            echo "<button class='btn btn-primary' style='margin:5px;' onclick='redirect(\"".$action_page."\");'>".$action_txt."</button>";
                        }
                        ?>
                   <br><br>
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
          <h5 class="modal-title" id="exampleModalLabel">Tem certeza que deseja sair?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Clique em "Sair" para encerrar a sessão.</div>
        <div class="modal-footer">
          <button class="btn btn-danger" type="button" data-dismiss="modal">Voltar</button>
          <a class="btn btn-primary" href="login.php?action=logout">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function load(){
      document.getElementById("li_roadmap").classList.add('active');
    }

    function goBack() {
      window.history.back();
    }

    function redirect(url) {
      console.log(url);
      window.location.href = url;
    }

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>

