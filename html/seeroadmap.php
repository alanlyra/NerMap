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
            <h1 class="h3 mb-0 text-gray-800">Geração de Roadmaps</h1>
          </div>

          <!-- Content Row -->

              <?php 

                if(isset($_GET["arquivo"]) || isset($_GET["roadmap"])) {
                echo "<div class='col-xl-11 col-lg-12'>
                        <div class='card shadow mb-4'>
                          <div class='card-header py-3'>
                            <h6 class='m-0 font-weight-bold text-primary'>Roadmap para a área de...</h6>
                          </div>

                          <div class='container' style='background: white !important; max-height: 55vh; overflow: auto;'>";

                          if(isset($_GET["arquivo"]))   
                            $id_arquivo = $_GET["arquivo"];
                          if(isset($_GET["roadmap"])) {  
                            $id_roadmap = $_GET["roadmap"];
                            $id_busca = $id_roadmap;
                            $key = "id_prospec";
                          }
                          else {
                            $id_busca = $id_arquivo;
                            $key = "id_arquivo";
                          }


                          $search_results=get_data('SELECT * FROM arquivos a INNER JOIN texto t ON t.id_texto = a.id_arquivo INNER JOIN ren r ON r.id_ren = t.id_texto INNER JOIN prospec p ON p.id_prospec = a.id_prospec_arquivo AND r.ordem_texto = t.ordem WHERE ' . $key . ' = ' . $id_busca . 'order by id_arquivo, ordem_texto');

                          $results_max = pg_num_rows($search_results);

                            if  ($results_max>0) {
                            //Processo para coletar os acontecimentos do Roadmap
                            $side_left = true;
                            $section = array(
                                date => "",
                                temppred => "",
                                info => "",
                                asunto => "",
                                section => "",
                                id_section => "",
                                ordem => "",
                                is_prospec => false,
                                has_date => false,
                                has_temppred => false,
                            );
                            $array_sections = [];
                            $i = 0;
                            $i_section = 0;
                            while($result=pg_fetch_object($search_results)) {

                              //echo "<script>console.log('Debug Objects: " . $result->palavra . "' );</script>";

                              $palavra = $result->palavra;
                              $palavra = str_replace(array("\r", "\n"), '', $palavra);
                              $palavra = str_replace(array("'"), '\\\'', $palavra);
                              $palavra = str_replace(array('"'), '\\\"', $palavra);

                              if($palavra == "." || $palavra == "," || $palavra == ":")
                                $section[info] = rtrim($section[info], " ");

                              $section[info] .= $palavra . " ";

                              if($palavra == ".") {
                                $section[assunto] = $result->assunto_prospec;
                                $array_sections[$i_section] = $section;

                                echo "<script>console.log('Index: " . $i . " Section: " . $i_section . "');</script>";
                                $section[date] = "";
                                $section[info] = "";
                                $section[has_date] = false;
                                $section[has_temppred] = false;
                                $section[is_prospec] = false;
                                $i_section++;
                              }

                              $tag = $result->tag;

                              if($tag != "O" && $tag != "" && $tag != null) {

                                if($tag == "DATE") {
                                  if($palavra != "today") {
                                    $section[date] = $result->palavra;
                                    $section[has_date] = true;
                                  }
                                }
                                if($tag == "U_TEMPPRED" || $tag == "B_TEMPPRED" || $tag == "M_TEMPPRED" || $tag == "E_TEMPPRED") {
                                  if($palavra != "today") {
                                    $section[temppred] = $result->palavra;
                                    $section[has_temppred] = true;
                                  }
                                }

                                if($section[has_date] && $section[has_temppred]) {
                                  $section[is_prospec] = true;
                                }
                            
                              }
                            $i++;
                            }
                          }

                          echo "<ul class='timeline'>
                          <li><div class='tldate'>2020</div></li>";


                          for ($j = 0; $j < sizeof($array_sections); $j++) {
                            if($array_sections[$j][is_prospec]) {
                              if($side_left)
                                echo "<li>";
                              else
                                echo "<li class='timeline-inverted'>";
                              echo "<div class='tl-circ'></div>
                                      <div class='timeline-panel'>
                                        <div class='tl-heading'>
                                          <h4>".$array_sections[$j][assunto]."</h4>
                                          <p><small class='text-muted'><i class='glyphicon glyphicon-time'></i>".$array_sections[$j][date]."</small></p>
                                        </div>
                                        <div class='tl-body'>
                                          <p>".$array_sections[$j][info]."</p>
                                        </div>
                                      </div>
                                    </li>";
                              $side_left = !$side_left;
                            }
                          }

                  echo "</ul>
                      </div>
                      </div>
                    </div>";
                  }
                  else {
                    echo "<div class='card shadow mb-4'>
                      <div class='card-header py-3'>
                        <h6 class='m-0 font-weight-bold text-primary'>Selecione uma prospecção para gerar roadmap</h6>
                      </div>
                      <div class='card-body'>
                        <div class='table-responsive'>
                          <table class='table table-bordered' id='table-prospec' width='100%' cellspacing='0'>
                            <thead>
                              <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tema</th>
                                <th>Ano</th>
                                <th>Status</th>
                                <th>Roadmap completo</th>
                                <th>Roadmap por arquivo</th>
                              </tr>
                            </thead>
                            <tbody>";

                              $search_prospec=get_data("SELECT * FROM prospec WHERE usuario_prospec = '". $_SESSION['email'] ."'order by id_prospec");

                              $results_max = pg_num_rows($search_prospec);

                              if  ($results_max>0) {
                                  while($result=pg_fetch_object($search_prospec)) {
                                    echo "<tr>
                                          <td>".$result->id_prospec."</td>
                                          <td>".$result->nome_prospec."</td>
                                          <td>".$result->assunto_prospec."</td>
                                          <td>".$result->ano_prospec."</td>
                                          <td><div style='text-align: center;'><img src='img/".$result->status_ren_prospec.".png' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                                          <td><a href='/seeroadmap.php?roadmap=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                          <td><a href='#' data-target='#myModal' data-toggle='modal' data-id='".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                        </tr>";
                                  }
                              }

                            echo "
                            </tbody>
                          </table>
                        </div>
                      </div>
                    </div>";
                  }

              ?> 
            
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

  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Arquivos do Roadmap</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>       
        </div>
        <div class="modal-body">
          <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Selecione um arquivo para gerar roadmap</h6>
            </div>
            <div class="card-body">
              <div id="table-modal" class="table-responsive">
                
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        </div>
      </div>

    </div>
  </div>

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
    var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
            data_id = $(this).data('id');
          }
          console.log(data_id);
          $.ajax({
            url: "table-arquivos-modal.php",
            method: "POST",
            data: { "identificador": data_id },
            success: function(html) {
              $('#table-modal').html(html);
              $('#myModal').modal('show');
            }
          })

        })
    });  
  </script>

  <script>
    function load(){
      document.getElementById("li_seerodmaps").classList.add('active');
    }

    $(document).ready(function() {
      $('#table-prospec').DataTable();
    });

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

</body>
</html>


