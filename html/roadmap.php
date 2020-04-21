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

          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Novo Technology Roadmapping</h1>
          </div>

          <!-- Content Row -->

          <div class="row justify-content-center">

            <!-- Project Card Example -->
            <div class="col-xl-11 col-lg-10">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Inserir dados</h6>
                </div>
                <div id="messageCampos" style="display: none;" class="alert alert-warning ">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                  </button>    <strong>Atenção!</strong> Todos os campos devem ser preenchidos.
                </div>
                
                </br>

                <form action="roadmap.php" method="post" multipart="" enctype="multipart/form-data">
               
                  <div class="col-xl-6 col-lg-7">
                   <h5>Nome:</h5>
                    <input type="text" id="nomeRoadmap" name="nomeRoadmap" class="form-control bg-light border-0 small" placeholder="Nome do TRM..." aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                  </br>
                  <div class="col-xl-6 col-lg-7">
  		              <h5>Área:</h5>
                    <select type="text" id="temaRoadmap" name="temaRoadmap" class="form-control" style="cursor: pointer;" required>
                      <option value="" disabled selected>Selecione a área...</option>
                      <option value="Educação">Educação</option>
                      <option value="Medicina">Medicina</option>
                      <option value="Transporte">Transporte</option>
                      <option value="Trabalho">Trabalho</option>
                    </select>
                  </div>
  		            </br>
              		<div class="col-xl-6 col-lg-7">
              		<h5>Ano limite do TRM:</h5>
                    <input type="text" id="anoRoadmap" name="anoRoadmap" class="form-control bg-light border-0 small" placeholder="Ano..." aria-label="Search" aria-describedby="basic-addon2" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                  </div>
                  </br>
                  <div class="py-3" style="text-align: center;">
                    <input class="btn btn-primary btn-icon-split" type="submit" name="criaTRM" value="Criar" style="width: 8em; height: 2em; display: inline-block;" />
                  </div>   
                </div>
                
                </form>
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
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Voltar</button>
          <a class="btn btn-primary" href="login.php?action=logout">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <script>
    function load(){
      document.getElementById("li_roadmap").classList.add('active');
    }

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>


<?php
	//echo '<pre>';

  if(isset($_POST["criaTRM"])) {

  	$nome = $_POST['nomeRoadmap'];
  	$tema = $_POST['temaRoadmap'];
  	$ano = $_POST['anoRoadmap'];


  	if(!$nome == "" && !$tema == "" && !$ano == "") {   	
    	  $id_prospec = get_max_id_prospec();
        db_prospec($id_prospec, $nome, $tema, $ano);
  	}
  	else{
      echo "<script> document.getElementById('messageCampos').style.display = 'block'; </script>";
  		//echo "<script>console.log( 'Deu ruim!' );</script>";
  	}

  }

	function get_max_id_prospec() {   
		$number1 = get_data("select MAX(id_prospec) from prospec");
		$row = pg_fetch_array($number1);				
		$number2 = $row[0];	
		$number = $number2 + 1;
    return $number;
  }

  //TODO: REMOVER INSERÇÃO DE STATUS E CONFIABILIDADE
	function db_prospec($id_prospec_db, $nome_db, $tema_db, $ano_db) {   
        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_prospec_db, $nome_db, $tema_db, $ano_db, 0, 'null', 10, $_SESSION['email']));
        //echo "<script>window.location.href = 'success.php?action=trm-adicionado';</script>";
        echo "<script>window.location.href = 'prospeccoes.php';</script>";
    }
?>