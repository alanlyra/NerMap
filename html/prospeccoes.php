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

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Prospecções Tecnológicas</h1>
    
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Relatórios de Prospecção</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th>Nº de arquivos</th>
                      <th>Adicionar arquivo</th>
                      <th>Status</th>
                      <th>Arquivo</th>
                      <th>Roadmap</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th>Nº de arquivos</th>
                      <th>Adicionar arquivo</th>
                      <th>Status</th>
                      <th>Arquivo</th>
                      <th>Roadmap</th>
                    </tr>
                  </tfoot>
                  <tbody>
              		<?php 
                  	$search_results=get_data("SELECT * FROM prospec WHERE usuario_prospec = '". $_SESSION['email'] ."'order by id_prospec");

		              	$results_max = pg_num_rows($search_results);

      				    	if  ($results_max>0) {
      							while($result=pg_fetch_object($search_results)) {
      						    	echo "<tr>
        							    		  <td>".$result->id_prospec."</td>
        	                      <td>".$result->nome_prospec."</td>
        	                      <td>".$result->assunto_prospec."</td>
        	                      <td>".$result->ano_prospec."</td>
        	                      <td>".$result->num_textos_prospec."</td>
                                <td><a href='#' data-target='#myModal' data-toggle='modal' data-id='".$result->id_prospec."'><div style='text-align: center;'><img src='img/file_add.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                <td><div style='text-align: center;'><img src='img/".$result->status_ren_prospec.".png' style='width: 20px; height: 20px; display: inline-block;'/></div></td>
                                <td><a href='/relatorios/relatorio_".$result->id_prospec.".txt' download><div style='text-align: center;'><img src='img/icon_doc.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                                <td><a href='/seeroadmap.php?roadmap=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
      	                      </tr>";
      		                	}
      						  }
                	?>
                  </tbody>
                </table>
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



  <!-- Modal -->
  <div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Adicionar arquivo ao Roadmap</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         <form action="prospeccoes.php" method="post" multipart="" enctype="multipart/form-data">

                  <div class="col-xl-6 col-lg-7">
                    <input type="file" name="files[]" multiple accept="text/*">
                    
                    </br>
                  </div>
                  </br>
                  <div class="col-xl-9 col-lg-10s">
                   <h5>Nome:</h5>
                    <input type="text" id="nomeArquivo" name="nomeArquivo" class="form-control bg-light border-0 small" placeholder="Nome do Roadmap..." aria-label="Search" aria-describedby="basic-addon2">
                  </div>
                 </br>
                  <div class="col-xl-6 col-lg-7">
                  <h5>Data:</h5>
                    <input type="text" id="anoArquivo" name="anoArquivo" class="form-control bg-light border-0 small" placeholder="Ano da Publicação..." aria-label="Search" aria-describedby="basic-addon2" onkeyup="this.value=this.value.replace(/[^\d]/,'')">
                  </div>
                  </br>
                  
                  <div class="col-xl-12 col-lg-12">
                  <h5>Confiabilidade:</h5>
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option1" value="1" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_0.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_0_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option2" value="3" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_2.5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_2.5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option3" value="5" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option4" value="8" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_7.5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_7.5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option5" value="10" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check checked"></span>
                      <div>
                        <!-- <img src="img/conf_10.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_10_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                  </div>
                </div>

   
                <input type="text" id="identificador" name="identificador" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2" style="display: none; visibility: hidden;">
             
                <div class="card-header py-3" style="text-align: center;">
                <input class="btn btn-primary btn-icon-split" type="submit" name="someAction" value="Enviar" style="width: 8em; height: 2em; display: inline-block;" />
                  </br>
                </div>
                </form>
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
    function load(){
      document.getElementById("li_prospec").classList.add('active');
    }

    var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
            data_id = $(this).data('id');
          }
          console.log(data_id);
          document.getElementById('identificador').value = data_id;

        })
    });

    function reloadtable(){
      $("#dataTable").load(window.location.href + " #dataTable" );
    }
  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php
  echo '<pre>';
  $file = $_FILES['files'];;
  $ano = $_POST['anoArquivo'];
  $nome = $_POST['nomeArquivo'];
  $conf_value = $_POST['rate'];
  $identificador = $_POST['identificador'];

  if($identificador) {
    if(!empty($file))
    {
      if(!$nome == "" && !$conf_value == "" && !$ano == "") {
          echo "<script>console.log( 'Confiabilidade: " . $conf_value . "' );</script>";
          echo "<script>console.log( 'Ano: " . $ano . "' );</script>";
          
          $id_arquivo = get_max_id_arquivo();
          echo "<script>console.log( 'ID ARQUIVO: " . $id_arquivo . "' );</script>";
          $file_desc = reArrayFiles($file);
          print_r($file_desc);
          $num_textos = 0;
          
          foreach($file_desc as $val)
          {
            //$newname = date('YmdHis',time()).mt_rand().'.jpg';
            $newname = get_max_id_arquivo();
            if($num_textos > 0) {
              $newname .= "_";
              $other_text = $num_textos + 1;
              $newname .= $other_text;
            }
            $newname .= ".txt";
            move_uploaded_file($val['tmp_name'],'uploads/'.$newname); 
            $num_textos++;          
          }
         
          db_arquivo($id_arquivo, $conf_value, $ano, "PROCESSANDO", $nome, $identificador);
          $num_arquivos = get_num_arquivos_on_prospec($identificador);
          db_prospec($identificador, $num_arquivos);


          popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos, "r");
          }
      else{
        echo "<script>console.log( 'Deu ruim!!' );</script>";
      }
    }
  }

  function reArrayFiles($file)
  {
      $file_ary = array();
      $file_count = count($file['name']);
      $file_key = array_keys($file);
      
      for($i=0;$i<$file_count;$i++)
      {
          foreach($file_key as $val)
          {
              $file_ary[$i][$val] = $file[$val][$i];
          }
      }
      return $file_ary;
  }

  function get_max_id_arquivo() {   
    $number1 = get_data("select MAX(id_arquivo) from arquivos");
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $number = $number2 + 1;

        echo "<script>console.log( 'ID ARQUIVO function: " . $number . "' );</script>";
        return $number;
  }

  function get_num_arquivos_on_prospec($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo =".$id_prospec);
    $row = pg_fetch_array($number1);        
    $number = $row[0]; 

        return $number;
  }

  function db_arquivo($id_arquivo_db, $conf_value_db, $ano_db, $status_ren_db, $nome_arquivo_db, $identificador_db) {   
      echo "<script>console.log( 'Gravando no banco' );</script>";
      $save_on_arquivos = set_data("INSERT INTO arquivos (id_arquivo, nome_arquivo, ano_prospec, autores_arquivo, conf_arquivo, id_prospec_arquivo, status_ren, usuario_arquivo) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_arquivo_db, $nome_arquivo_db, $ano_db, 1, $conf_value_db, $identificador_db, 'PROCESSANDO', $_SESSION['email']));
      echo "<script>console.log( 'Gravado com sucesso' );</script>";
    }

  function db_prospec($id_prospec_db, $num_arquivos_db) {   
    $save_on_prospec = set_data("UPDATE prospec SET num_textos_prospec = ".$num_arquivos_db." WHERE id_prospec = ".$id_prospec_db);
    echo "<script>reloadtable();;</script>";
  }
?>
