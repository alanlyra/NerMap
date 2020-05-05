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
            <h1 class="h3 mb-0 text-gray-800">Painel de Início</h1>
          </div>

          <!-- Content Row -->

          <div class="row">

            <!-- Project Card Example -->
            <div class="col-xl-5 col-lg-5">
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Novo Technology Roadmapping</h6>
                </div>
                <div id="messageCampos" style="display: none;" class="alert alert-warning ">
                 <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true" style="font-size:20px">×</span>
                  </button>    <strong>Atenção!</strong> Todos os campos devem ser preenchidos.
                </div>
                

                <form action="roadmap.php" method="post" multipart="" enctype="multipart/form-data">
               
                  <div class="col-xl-11 col-lg-11" style="margin-top:2.5vh;">
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


            

              <div class="col-xl-7 col-lg-7">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Workplace</h6>
                  </div>
                  <div class="row justify-content-center divWorkplace">
                  <div class="col-sm-5 col-md-5">
                    <div class="col-md-12 feature-box">
                    <img src="img/files2.png" style="width: 100px; height: 100px; display: inline-block;"/>
                      <h4>TRMs & Arquivos</h4>
                      <p style="height: 3rem;">Seus TRMs e arquivos cadastrados no sistema.</p>
                      <a href="prospeccoes.php"><button class="btn btn-primary" style="margin:5px;">Acessar</button></a>
                    </div>
                  </div> <!-- End Col -->
                  <div class="col-sm-5 col-md-5">
                    <div class="col-md-12 feature-box">
                    <img src="img/timeline6.png" style="width: 130px; height: 100px; display: inline-block;"/>
                      <h4>Roadmaps</h4>
                      <p style="height: 3rem;">Seus roadmaps gerados e editados.</p>
                      <a href="seeroadmap.php"><button class="btn btn-primary" style="margin:5px;">Acessar</button></a>
                    </div>
                  </div> <!-- End Col -->	
                </div>
              </div>
            
            </div>
          </div>
          <div class="row">
            <div class="col-xl-8 col-lg-8">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Análise de Uso</h6>
                    
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="divAnalise">

                    <div class="row">

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="card border-left-primary shadow py-2" style="height: 75px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">TRMs</div>
                                <div id="num-trms" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card border-left-primary shadow py-2" style="height: 75px; margin-top:20px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Arquivos</div>
                                <div id="num-arquivos" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="card border-left-primary shadow py-2" style="height: 75px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Roadmaps</div>
                                <div id="num-roadmaps" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="card border-left-primary shadow py-2" style="height: 75px; margin-top:20px;">
                          <div style="padding: 0.5rem !important;">
                            <div class="row no-gutters align-items-center">
                              <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Prospecções</div>
                                <div id="num-prospeccoes" class="h6 mb-0 font-weight-bold text-gray-800"></div>
                              </div>
                              <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gráfico Temas:</div>
                        <div style="padding: 0.5rem !important;">                        
                          <canvas id="myPieChart"></canvas>
                         
                        </div>
                      </div>

                      <div class="col-xl-3 col-md-3 mb-3">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Gráfico Temporal:</div>
                        <div style="padding: 0.5rem !important;">                         
                          <canvas id="myPieChart2"></canvas>
                        </div>
                      </div>

                    </div>


                    </div>
                  </div>
                </div>
              </div>

              <div class="col-xl-4 col-lg-4">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Sobre</h6>
                    <div class="dropdown no-arrow">
                      <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                      </a>
                      <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                        <div class="dropdown-header">Acessar:</div>
                        <a class="dropdown-item" href="#">Dissertação</a>
                        <a class="dropdown-item" href="#">PESC</a>
                      </div>
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="divMetodologia">
                    <p> O framework NERMAP foi desenvolvido para ser uma ferramenta de Prospecção Tecnológica, de modo a semi-automatizar o processo de Technology Roadmapping. O processo é feito através do método de Reconhecimento de Entidades Nomeadas em texto.</p>
                    </div>
                    <div class="mt-4 text-center small">
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.cos.ufrj.br/" class="nermap_font_copyright">PESC</a></span>
                      </span>
                      <span class="mr-2">
                        <span> · </span>
                      </span>
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.coppe.ufrj.br/" class="nermap_font_copyright">COPPE</a></span>
                      </span>
                      <span class="mr-2">
                        <span> · </span>
                      </span>
                      <span class="mr-2">
                        <span class="nermap_font_copyright"><a href="http://www.ufrj.br/" class="nermap_font_copyright">UFRJ</a></span>
                      </span>
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

  <?php

    //Coleta informações do banco para a área de análise
    $number6 = get_data("SELECT id_prospec_grupos FROM grupos where id_user_grupos = ".$_SESSION["id"]." AND accepted = true");

    $results_max6 = pg_num_rows($number6);
    $num_trms_user = $results_max6;
    $num_arquivos_user = 0;
    $num_roadmaps_user = 0;
    $num_prospeccoes_user = 0;

    if  ($results_max6>0) {
      while($result6=pg_fetch_object($number6)) {
        $number5 = get_data("SELECT num_textos_prospec FROM prospec where id_prospec = ".$result6->id_prospec_grupos);
        $row5 = pg_fetch_array($number5);        
        $numero_arquivos_user_tmp = $row5[0];
        $num_arquivos_user += $numero_arquivos_user_tmp;

        $number7 = get_data("SELECT COUNT(*) FROM roadmap where id_prospec_roadmap = ".$result6->id_prospec_grupos);
        $row7 = pg_fetch_array($number7);        
        $num_prospeccoes_user_tmp = $row7[0];
        $num_prospeccoes_user += $num_prospeccoes_user_tmp;
      }
    }

    $num_roadmaps_user = $num_trms_user + $num_arquivos_user;

  ?>



  <!-- Page level plugins -->
  <script src="vendor/chart.js/Chart.min.js"></script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <script>
    function load(){
      document.getElementById("li_roadmap").classList.add('active');
    }

    var ctx = document.getElementById("myPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Trabalho", "Educação", "Medicina"],
        datasets: [{
          data: [6, 5, 4],
          backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

    var ctx = document.getElementById("myPieChart2");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["2050", "2060", "2070"],
        datasets: [{
          data: [8, 2, 5],
          backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
          hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 80,
      },
    });

    document.getElementById("myPieChart").style.width = "170px";
    document.getElementById("myPieChart").style.height = "140px";
    document.getElementById("myPieChart2").style.width = "170px";
    document.getElementById("myPieChart2").style.height = "140px";


    var numTRMsUserJS = "<?php echo $num_trms_user; ?>";
    var numArquivosUserJS = "<?php echo $num_arquivos_user; ?>";
    var numRoadmapsUserJS = "<?php echo $num_roadmaps_user; ?>";
    var numProspeccoesUserJS = "<?php echo $num_prospeccoes_user; ?>";

    if(numTRMsUserJS == 1) document.getElementById("num-trms").innerHTML = numTRMsUserJS + " TRM";
    else document.getElementById("num-trms").innerHTML = numTRMsUserJS + " TRMs";

    if(numArquivosUserJS == 1) document.getElementById("num-arquivos").innerHTML = numArquivosUserJS + " arquivo";
    else document.getElementById("num-arquivos").innerHTML = numArquivosUserJS + " arquivos";

    if(numRoadmapsUserJS == 1) document.getElementById("num-roadmaps").innerHTML = numRoadmapsUserJS + " roadmap";
    else document.getElementById("num-roadmaps").innerHTML = numRoadmapsUserJS + " roadmaps";

    if(numProspeccoesUserJS == 1) document.getElementById("num-prospeccoes").innerHTML = numProspeccoesUserJS + " prospecção";
    else document.getElementById("num-prospeccoes").innerHTML = numProspeccoesUserJS + " prospecções";


  </script>

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
        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_prospec_db, $nome_db, $tema_db, $ano_db, 0, 'null', 10, $_SESSION['id']));
        db_grupos($id_prospec_db);
        //echo "<script>window.location.href = 'success.php?action=trm-adicionado';</script>";
        echo "<script>window.location.href = 'prospeccoes.php';</script>";
    }

  function db_grupos($id_prospec_db) {   
    $save_on_grupos = set_data("INSERT INTO grupos (id_prospec_grupos, id_user_grupos, accepted) VALUES ($1, $2, $3)", array($id_prospec_db, $_SESSION['id'], true));
  }
  
?>



 
