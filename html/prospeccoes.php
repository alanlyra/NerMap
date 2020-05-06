<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

<!DOCTYPE html>
<html lang="en">

<?php include 'pdfparser/vendor/autoload.php'; ?>

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
          <h1 class="h3 mb-2 text-gray-800">Gerenciar TRMs</h1>
    
          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">	
            <button style='display: none; float:right; border: 0; margin: 0px; background: transparent;' onclick='reloadPage();'>
         		<img src='img/refresh5.png' style='width: 20px; height: 20px; display: inline-block;'/>
        	 </button>                 	
              <h6 class="m-0 font-weight-bold text-primary" style="float:left;">Technology Roadmappings</h6>

              <?php
                
                $search_results=get_data("SELECT id_prospec_grupos, id_user_grupos, accepted, id_user_convite, email, name_user, photo, nome_prospec, assunto_prospec, ano_prospec, num_textos_prospec, status_ren_prospec, conf_prospec, usuario_prospec FROM grupos g INNER JOIN users u ON g.id_user_convite = u.id_user INNER JOIN prospec p ON g.id_prospec_grupos = p.id_prospec WHERE g.accepted = 'false' AND g.id_user_convite is not null AND g.id_user_grupos = ".$_SESSION['id']);

                $results_max = pg_num_rows($search_results);
           
              ?>

              <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow" style="background-color: whitesmoke; float:right; margin:0; height:15px; padding: 0; margin-bottom: 0px !important;">

            <ul class="navbar-nav ml-auto">
              <!-- Nav Item - Messages -->
              <li class="nav-item dropdown no-arrow mx-1 show" style="list-style:none;">
                <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" style="height: 5px;">
                  <i class="fas fa-envelope fa-fw" title="Convites"></i>
                  <!-- Counter - Messages -->
                  <?php
                    if ($results_max>0)
                      echo "<span class='badge badge-danger badge-counter'>".$results_max."</span>";
                  ?>
                </a>
                <!-- Dropdown - Messages -->
                <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                  
                  <h6 class="dropdown-header">
                    Convites
                  </h6>

                  <?php
                    if ($results_max>0) {
                      $h = $results_max * 85;
                      if ($h > 256)
                        echo "<div style='height: 255px; width: 500px; overflow: auto;'>";
                      else
                        echo "<div style='height: ".$h."px; width: 500px; overflow: auto;'>";
                    }
                    else
                    echo "<div style='height: 0px; width: 500px; overflow: auto;'>";
                  ?>
                  
                  <?php

                      if ($results_max>0) {

                        while($result2=pg_fetch_object($search_results)) {

                          echo "<a class='dropdown-item d-flex align-items-center' href='#' style='cursor: default;'>
                                  <div class='dropdown-list-image mr-3'>
                                    <img class='rounded-circle' src='".$result2->photo."' alt='' style='width:50px; height:50px;'>
                                  </div>
                                  <div class='font-weight-bold'>
                                    <div class='text-truncate'>".$result2->nome_prospec."</div>
                                    <div class='small text-gray-500'>".$result2->name_user." te convidou para participar do TRM.</div>

                                    <form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
                                      <input type='text' id='idProspec' name='idProspecGrupos' class='form-control bg-light border-0 small' value='".$result2->id_prospec_grupos."' aria-label='Search' 
                                      aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                                      <input type='text' id='idUsuarioConvidado' name='idUsuarioConvidado' class='form-control bg-light border-0 small' value='".$result2->id_user_grupos."' aria-label='Search' 
                                      aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                                      <input type='text' id='idUsuarioConvite' name='idUsuarioConvite' class='form-control bg-light border-0 small' value='".$result2->id_user_convite."' aria-label='Search' 
                                      aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
              
                                      <input class='button-transparent-aceitar' type='submit' name='aceitaConvite' value='Aceitar' style='float:left;'/>
                                      <div class='small text-gray-500' style='float:left; margin-left:3px; margin-right:3px;'> · </div>
                                      <input class='button-transparent-remover' type='submit' name='removeConvite' value='Remover' style='float:left; margin-left: 0.5px;'/>
                                    </form>

                                    
                                  </div>
                                </a>";

                        }
                      }

                  ?>
                  
                  </div>
                  <?php
                    if ($results_max>0)
                      if ($results_max==1)
                        echo "<a class='dropdown-item text-center small text-gray-500'>Você tem ".$results_max." convite pendente.</a>";
                      else
                        echo "<a class='dropdown-item text-center small text-gray-500'>Você tem ".$results_max." convites pendentes.</a>";
                    else
                      echo "<a class='dropdown-item text-center small text-gray-500'>Você não tem convites pendentes.</a>";
                  ?>
                  
                </div>
              </li>
            </ul>
            </nav>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th style="position:unset;"></th>
                      <th style="width: 300px">Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th style="width: 120px">Nº de arquivos</th>
                      <th style="position:unset;">Status</th>
                      <th style="width: 140px; position:unset;">Adicionar arquivo</th>
                      <th style="position:unset;">Arquivos</th>
                      <th style="position:unset;">Roadmap</th>
                      <th style="position:unset;">Ações</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th></th>
                      <th>Nome</th>
                      <th>Tema</th>
                      <th>Ano</th>
                      <th>Nº de arquivos</th>
                      <th>Status</th>
                      <th>Adicionar arquivo</th>
                      <th>Arquivos</th>
                      <th>Roadmap</th>
                      <th>Ações</th>
                    </tr>
                  </tfoot>
                  <tbody>
              		<?php 
                  	$search_results=get_data("SELECT * FROM prospec p INNER JOIN grupos g on g.id_prospec_grupos = p.id_prospec WHERE g.accepted = 'true' AND g.id_user_grupos =  '". $_SESSION['id'] ."' order by p.id_prospec");

		              	$results_max = pg_num_rows($search_results);

      				    	if  ($results_max>0) {
      							while($result=pg_fetch_object($search_results)) {
      						    	echo "<tr>
                                <td style='text-align: center;' width='30px;'>
                                  <div style='text-align: center;'>";
                                    if($result->usuario_prospec == $result->id_user_grupos)
                                      echo "<img src='img/manager2.png' title='Dono do TRM' style='width: 22px; height: 20px; display: inline-block; opacity:60%;'/>";
                                    else
                                      echo "<img src='img/shared5.png' title='Compartilhado com você' style='width: 20px; height: 20px; display: inline-block; opacity:70%;'/>";
                                echo "</div>
                                </td>
        	                      <td>".$result->nome_prospec."</td>
        	                      <td>".$result->assunto_prospec."</td>
        	                      <td style='width='2em;'>".$result->ano_prospec."</td>
        	                      <td>".$result->num_textos_prospec."</td>
        	                       <td><div style='text-align: center;'>";
                                if($result->status_ren_prospec != "null")
                                  echo "<img src='img/".$result->status_ren_prospec.".png' title='".$result->status_ren_prospec."' style='width: 20px; height: 20px; display: inline-block;'/>";
                                echo "</div></td>
                                <td><a href='#' data-target='#myModal' data-toggle='modal' data-id='".$result->id_prospec."'><div style='text-align: center;'><img src='img/file_add.png' title='Adicionar arquivo' style='width: 20px; height: 20px; display: inline-block;'/></a></td>
                               
                                <td><a href='#' data-target='#modalArquivos' data-toggle='modal' data-id='arquivos-".$result->id_prospec."'><div style='text-align: center;'><img src='img/ver_arquivos.png' title='Visualizar arquivos' style='width: 20px; height: 20px; display: inline-block;'/></a></td>

                                <td><a href='/seeroadmap.php?roadmap=".$result->id_prospec."'><div style='text-align: center;'><img src='img/timeline6.png' title='Ir para Roadmaps' style='width: 20px; height: 20px; display: inline-block;'/></a></td>


                                <td style='text-align: center;'>";
                                
                                if($result->usuario_prospec == $result->id_user_grupos) {
                                  echo " <a href='#' data-target='#modalUsuarios' data-toggle='modal' data-id='usuarios-".$result->id_prospec."' data-usuarioconvite='".$_SESSION['id']."' style='display: inline-block; margin-right:3px;'><div style='text-align: center;'><img src='img/shared5.png' title='Compartilhamento' style='width: 18px; height: 18px; display: inline-block; opacity:70%;'/></div></a>         

                                  <a href='#' data-target='#modalEditarTrm' data-toggle='modal' data-id='editartrm-".$result->id_prospec."' data-nometrm='".$result->nome_prospec."' data-tematrm='".$result->assunto_prospec."' data-anotrm='".$result->ano_prospec."' style='display: inline-block; margin-left:3px; margin-right:3px;'><div style='text-align: center;'><img src='img/editar7.png' title='Editar informações do TRM' style='width: 18px; height: 18px; display: inline-block; opacity: 70%;'/></div></a>
                          
                                  <a href='#' data-target='#modalConfirmarDeleteProspec' data-toggle='modal' data-id='deleteprospec-".$result->id_prospec."' style='display: inline-block; margin-left:3px;'><div style='text-align: center;'><img src='img/deletar2.png' title='Remover TRM' style='width: 18px; height: 18px; display: inline-block;'/></div></a>";
                                }
                                else{
                                  echo "<a href='#' data-target='#modalRemoveCompartilharmentoTRM' data-toggle='modal' data-id='removecompartilhamentoprospec-".$result->id_prospec."' data-usuarioremovecompartilhamento='".$_SESSION['id']."' style='display: inline-block; margin-left:3px;'><div style='text-align: center;'><img src='img/out5.png' title='Sair do TRM' style='width: 22px; height: 22px; display: inline-block; opacity: 70%;'/></div></a>";
                                }

                                echo "</td>

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
          <h4 class="modal-title">Adicionar arquivo ao TRM</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
         <form action="prospeccoes.php" method="post" multipart="" enctype="multipart/form-data">

                  <div class="col-xl-6 col-lg-7">
                    <!-- <input type="file" name="files[]" multiple accept="text/*"> -->
                    <input type="file" name="files[]" accept=".txt,.pdf" required>
                    
                    </br>
                  </div>
                  </br>
                  <div class="col-xl-9 col-lg-10s">
                   <h5>Título:</h5>
                    <input type="text" id="nomeArquivo" name="nomeArquivo" class="form-control bg-light border-0 small" placeholder="Nome do Arquivo..." aria-label="Search" aria-describedby="basic-addon2" required>
                  </div>
                 </br>
                  <div class="col-xl-6 col-lg-7">
                  <h5>Data:</h5>
                    <input type="text" id="anoArquivo" name="anoArquivo" class="form-control bg-light border-0 small" placeholder="Ano da Publicação..." aria-label="Search" aria-describedby="basic-addon2" onkeyup="this.value=this.value.replace(/[^\d]/,'')" required>
                  </div>
                  </br>
                  
                  <div class="col-xl-12 col-lg-12">
                  <h5>Confiabilidade:</h5>
                  <div class="btn-group" data-toggle="buttons">
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option1" value="1" autocomplete="off" style="cursor: pointer;" required> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check"></span>
                      <div>
                        <!-- <img src="img/conf_1.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_1_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option2" value="3" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check"></span>
                      <div>
                        <!-- <img src="img/conf_3.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_3_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                    <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option3" value="5" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check"></span>
                      <div>
                        <!-- <img src="img/conf_5.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_5_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option4" value="8" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check"></span>
                      <div>
                        <!-- <img src="img/conf_8.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_8_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                     <label class="btn btn-plain" style="cursor: pointer;">
                      <input type="radio" name="rate" id="option5" value="10" autocomplete="off" style="cursor: pointer;"> <span class="glyphicon glyphicon-unchecked unchecked"></span> <span class="glyphicon glyphicon-check"></span>
                      <div>
                        <!-- <img src="img/conf_10.png" style="width: 40px; height: 40px;" /> -->
                        <img src="img/conf_10_bw.png" style="width: 40px; height: 40px;" />
                      </div>
                    </label>
                  </div>
                </div>

   
                <input type="text" id="identificador" name="identificador" class="form-control bg-light border-0 small" placeholder="" aria-label="Search" aria-describedby="basic-addon2" style="display: none; visibility: hidden;">
             
                <div class="py-3" style="text-align: center;">
                <input class="btn btn-primary btn-icon-split" type="submit" name="adicionarArquivo" value="Adicionar" style="width: 8em; height: 2em; display: inline-block;" />
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
          <button class="btn btn-danger" type="button" data-dismiss="modal">Voltar</button>
          <a class="btn btn-primary" href="login.php?action=logout">Sair</a>
        </div>
      </div>
    </div>
  </div>

  <div id="modalArquivos" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Arquivos do TRM</h4>
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

  <div id="modalEditarTrm" class="modal fade" role="dialog">
    <div id="edicao-trm" class="modal-dialog">
      <!-- Modal content-->
      
    </div>
  </div>

  <!-- Confirma Remoção do TRM Modal-->
  <div class="modal fade" id="modalConfirmarDeleteProspec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="delete-trm" class="modal-dialog" role="document">
      
    </div>
  </div>

  <!-- Confirma Sair do compartilhamento do TRM Modal-->
  <div class="modal fade" id="modalRemoveCompartilharmentoTRM" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="remove-compartilhamento-trm" class="modal-dialog" role="document">
      
    </div>
  </div>

  <!-- Modal de Usuários-->
  <div id="modalUsuarios" class="modal fade" role="dialog">
    <div class="modal-dialog modal-xl">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Compartilhamento do TRM</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>       
        </div>
        <div class="modal-body">
          <!-- DataTales Example -->
         <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Adicionar ou remover usuários do TRM</h6>
            </div>
            <div class="card-body">
              <div id="table-modal-usuarios" class="table-responsive">
                
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

          if (typeof $(this).data('nometrm') !== 'undefined') {
            data_nometrm = $(this).data('nometrm');
          }
          if (typeof $(this).data('tematrm') !== 'undefined') {
            data_tematrm = $(this).data('tematrm');
          }
          if (typeof $(this).data('anotrm') !== 'undefined') {
            data_anotrm = $(this).data('anotrm');
          }

          if (typeof $(this).data('deleteprospec') !== 'undefined') {
            deleteprospec = $(this).data('deleteprospec');
          }

          if (typeof $(this).data('usuarioconvite') !== 'undefined') {
            id_usuarioconvite = $(this).data('usuarioconvite');
          }

          if (typeof $(this).data('usuarioremovecompartilhamento') !== 'undefined') {
            id_usuarioremovecompartilhamento = $(this).data('usuarioremovecompartilhamento');
          }

          //console.log(data_id);
          var data_txt =  data_id.toString();
          var data_id_prospec = data_txt.replace('arquivos-','');
          var data_id_editarTrm = data_txt.replace('editartrm-','');
          var data_id_deleteprospec = data_txt.replace('deleteprospec-','');
          var data_id_usuarios = data_txt.replace('usuarios-','');
          var data_id_removecompartilhamentoprospec = data_txt.replace('removecompartilhamentoprospec-','');
          if(data_txt.indexOf('arquivos-') > -1) {
          	$.ajax({
	            url: "table-arquivos-modal-prospec.php",
	            method: "POST",
	            data: { "identificador": data_id_prospec },
	            success: function(html) {
	              $('#table-modal').html(html);
	              $('#modalArquivos').modal('show');
	            }
          	})
          } 
          else if (data_txt.indexOf('editartrm-') > -1) {
            $.ajax({
              url: "modal-editar-trm.php",
              method: "POST",
              data: { "identificador": data_id_editarTrm,
                      "nometrm": data_nometrm,
                      "tematrm": data_tematrm,
                      "anotrm": data_anotrm },
              success: function(html) {
                $('#edicao-trm').html(html);
                $('#modalEditarTrm').modal('show');
              }
            })
          }
          else if (data_txt.indexOf('deleteprospec-') > -1) {
            $.ajax({
              url: "modal-confirma-delete-trm.php",
              method: "POST",
              data: { "identificador": data_id_deleteprospec},
              success: function(html) {
                $('#delete-trm').html(html);
                $('#modalConfirmarDeleteProspec').modal('show');
              }
            })
          }
          else if(data_txt.indexOf('usuarios-') > -1) {
          	$.ajax({
	            url: "modal-usuarios-convite.php",
	            method: "POST",
	            data: { "identificador": data_id_usuarios,
                      "usuario": id_usuarioconvite },
	            success: function(html) {
	              $('#table-modal-usuarios').html(html);
	              $('#modalUsuarios').modal('show');
	            }
          	})
          }
          else if(data_txt.indexOf('removecompartilhamentoprospec-') > -1) {
          	$.ajax({
	            url: "modal-confirma-sair-compartilhamento.php",
	            method: "POST",
	            data: { "identificador": data_id_removecompartilhamentoprospec,
                      "usuario": id_usuarioremovecompartilhamento },
	            success: function(html) {
	              $('#remove-compartilhamento-trm').html(html);
	              $('#modalRemoveCompartilharmentoTRM').modal('show');
	            }
          	})
          } 
          else
          	document.getElementById('identificador').value = data_id;

        })
    });

    function reloadtable(){
      $("#dataTable").load(window.location.href + " #dataTable" );
    }

    function init_process(id_arquivo) {
    	$.ajax({
	            url: "init_process_input.php",
	            method: "POST",
	            data: { "id-arquivo": id_arquivo }
    	});
    }

    function reloadPage(){
      //window.location.href = 'prospeccoes.php';
    }

  </script>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="js/demo/datatables-demo.js"></script>

</body>

</html>

<?php

  if(isset($_POST["salvarEdicaoTRM"])) {

      $idRoadmap = $_POST['idRoadmap'];
      $nomeTrm = $_POST['nomeProspec'];
      $temaTrm = $_POST['temaProspec'];
      $anoTrm = $_POST['anoProspec'];

      $update_on_prospec = set_data("UPDATE prospec SET nome_prospec = $1, assunto_prospec = $2, ano_prospec = $3 where id_prospec = $4", array($nomeTrm, $temaTrm, $anoTrm, $idRoadmap));

      echo "<script>window.location.href = 'prospeccoes.php?';</script>";

  }

  if(isset($_POST["salvarEdicaoArquivo"])) {

    $idArquivo = $_POST['idArquivo'];
    $nomeArquivo = $_POST['nomeArquivo'];
    $anoArquivo = $_POST['anoArquivo'];
    $confArquivo = $_POST['confArquivo'];

    $update_on_arquivo= set_data("UPDATE arquivos SET nome_arquivo = $1, ano_arquivo = $2, conf_arquivo = $3 where id_arquivo = $4", array($nomeArquivo, $anoArquivo, $confArquivo, $idArquivo));

    echo "$('#modalEditarArquivo').modal('hide');";
    echo "$('#modalArquivos').modal('hide');";

    //echo "<script>window.location.href = 'prospeccoes.php?';</script>";

}

  if(isset($_POST["deleteProspec"])) {

    $id_prospec = $_POST["idProspec"];

    $ids_arquivos = set_data("SELECT id_arquivo FROM arquivos WHERE id_prospec_arquivo = $1", array($id_prospec));

    $results_max_ids_arquivos = pg_num_rows($ids_arquivos);

    if  ($results_max_ids_arquivos>0) {
      while($result=pg_fetch_object($ids_arquivos)) {
        remove_file_in_directory($result->id_arquivo);
      }
    }

    $remover_prospec = set_data(" DELETE FROM prospec WHERE id_prospec = $1", array($id_prospec));

    //echo "<script>reloadtable();;</script>";
    echo "<script>window.location.href = 'prospeccoes.php';</script>";

  }

  if(isset($_POST["deleteArquivo"])) {

      $id_arquivo = $_POST["idArquivo"];

      $id_prospec = $_POST["idProspec"];

      $remover_arquivo = set_data("DELETE FROM arquivos WHERE id_arquivo = $1", array($id_arquivo));

      $remover_roadmap = set_data("DELETE FROM roadmap WHERE id_prospec_roadmap = $1 AND id_arquivo_unico = $2", array($id_prospec, $id_arquivo));

      remove_file_in_directory($id_arquivo);

      $num_arquivos_prospec = get_num_arquivos_on_prospec($id_prospec);

      db_prospec($id_prospec, $num_arquivos_prospec);

  }

  if(isset($_POST["convidaUsuario"])) {

    $id_prospec = $_POST["idProspec"];
    $id_usuario_convidado = $_POST["idUsuarioConvidado"];
    $id_usuario_convite = $_POST["idUsuarioConvite"];

    $save_on_grupos = set_data("INSERT INTO grupos (id_prospec_grupos, id_user_grupos, accepted, id_user_convite) VALUES ($1, $2, $3, $4)", array($id_prospec, $id_usuario_convidado, 'false', $id_usuario_convite));

    echo "<script>window.location.href = 'prospeccoes.php';</script>";

  }

  if(isset($_POST["aceitaConvite"])) {

    $id_prospec = $_POST["idProspecGrupos"];
    $id_usuario_convidado = $_POST["idUsuarioConvidado"];
    $id_usuario_convite = $_POST["idUsuarioConvite"];

    $save_on_grupos = set_data("UPDATE grupos SET accepted = 'true' WHERE id_prospec_grupos = $1 AND id_user_grupos = $2 AND id_user_convite = $3", array($id_prospec, $id_usuario_convidado, $id_usuario_convite));

    echo "<script>window.location.href = 'prospeccoes.php';</script>";

  }

  if(isset($_POST["removeConvite"])) {

    $id_prospec = $_POST["idProspecGrupos"];
    $id_usuario_convidado = $_POST["idUsuarioConvidado"];
    $id_usuario_convite = $_POST["idUsuarioConvite"];

    $delete_on_grupos = set_data("DELETE from grupos WHERE id_prospec_grupos = $1 AND id_user_grupos = $2 AND id_user_convite = $3", array($id_prospec, $id_usuario_convidado, $id_usuario_convite));

    echo "<script>window.location.href = 'prospeccoes.php';</script>";

  }

  if(isset($_POST["removeCompartilhamento"])) {

    $id_prospec = $_POST["idProspec"];
    $id_usuario_compartilhamento = $_POST["idUsuarioCompartilhamento"];

    $delete_on_grupos = set_data("DELETE from grupos WHERE id_prospec_grupos = $1 AND id_user_grupos = $2 AND id_user_convite IS NOT NULL", array($id_prospec, $id_usuario_compartilhamento));

    echo "<script>window.location.href = 'prospeccoes.php';</script>";

  }

  function remove_file_in_directory($id_arquivo){
    if (file_exists("uploads/pdf/".$id_arquivo.".pdf"))
      unlink("uploads/pdf/".$id_arquivo.".pdf");
    if (file_exists("uploads/".$id_arquivo.".txt")) 
      unlink("uploads/".$id_arquivo.".txt");
    if (file_exists("relatorios/relatorio_".$id_arquivo.".txt"))  
      unlink("relatorios/relatorio_".$id_arquivo.".txt");
  }

?>



<?php
  
  if(isset($_POST["adicionarArquivo"])) {
    
    $file = $_FILES['files'];;
    $ano = $_POST['anoArquivo'];
    $nome = $_POST['nomeArquivo'];
    $conf_value = $_POST['rate'];
    $identificador = $_POST['identificador'];

    if($identificador) {
      if(!empty($file))
      {
        if(!$nome == "" && !$conf_value == "" && !$ano == "") {
            //echo "<script>console.log( 'Confiabilidade: " . $conf_value . "' );</script>";
            //echo "<script>console.log( 'Ano: " . $ano . "' );</script>";
            
            $id_arquivo = get_max_id_arquivo();
            //echo "<script>console.log( 'ID ARQUIVO: " . $id_arquivo . "' );</script>";
            $file_desc = reArrayFiles($file);
            //print_r($file_desc);
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

              $ext = pathinfo($val['name'], PATHINFO_EXTENSION);  

              if($ext == "pdf" || $ext == ".pdf" || $ext == "PDF" || $ext == ".PDF") {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf    = $parser->parseFile($val['tmp_name']);
                 
                // Retrieve all pages from the pdf file.
                $pages  = $pdf->getPages();

                $pdfUploaded = fopen("uploads/".$newname, "w") or die("Unable to open file!");
                 
                // Loop over each page to extract text.
                foreach ($pages as $page) {
                    fwrite($pdfUploaded, $page->getText());
                }

                fclose($pdf_uploaded);

                $newname_pdf = str_replace(".txt", ".pdf", $newname);
                move_uploaded_file($val['tmp_name'],'uploads/pdf/'.$newname_pdf);
              }
              else
                move_uploaded_file($val['tmp_name'],'uploads/'.$newname);	
              
              $num_textos++;          
            }
            
            db_arquivo($id_arquivo, $conf_value, $ano, "PROCESSANDO", $nome, $identificador);
            $num_arquivos = get_num_arquivos_on_prospec($identificador);
            db_prospec($identificador, $num_arquivos);


            //popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos, "r");
            }
        else{
          //echo "<script>console.log( 'Deu ruim!!' );</script>";
        }
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

        return $number;
  }

  function get_num_arquivos_on_prospec($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo =".$id_prospec);
    $row = pg_fetch_array($number1);        
    $number = $row[0]; 

        return $number;
  }

  function db_arquivo($id_arquivo_db, $conf_value_db, $ano_db, $status_ren_db, $nome_arquivo_db, $identificador_db) {   
      $save_on_arquivos = set_data("INSERT INTO arquivos (id_arquivo, nome_arquivo, ano_arquivo, autores_arquivo, conf_arquivo, id_prospec_arquivo, status_ren, usuario_arquivo) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_arquivo_db, $nome_arquivo_db, $ano_db, 1, $conf_value_db, $identificador_db, 'PROCESSANDO', $_SESSION['id']));
      echo "<script>init_process(".$id_arquivo_db.");</script>"; 
    }

  function db_prospec($id_prospec_db, $num_arquivos_db) {   
    $save_on_prospec = set_data("UPDATE prospec SET num_textos_prospec = ".$num_arquivos_db." WHERE id_prospec = ".$id_prospec_db);
    $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'PROCESSANDO' where id_prospec = $1", array($id_prospec_db));
    //echo "<script>reloadtable();</script>";
    echo "<script>window.location.href = 'prospeccoes.php';</script>";
  }
?>

<?php
	$number3 = get_data("SELECT id_prospec FROM prospec WHERE usuario_prospec = '".$_SESSION['id']."'");
    $row3 = pg_fetch_all($number3);

    for($j=0; $j < sizeof($row3); $j++) {
    	if(has_arquivo_processando($row3[$j][id_prospec]))
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'PROCESSANDO' where id_prospec = $1", array($row3[$j][id_prospec]));
    	else if (has_arquivo_com_erro($row3[$j][id_prospec]))
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'ERROR' where id_prospec = $1", array($row3[$j][id_prospec]));
    	else
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($row3[$j][id_prospec]));
      //echo "<script>reloadtable();</script>";
    } 


    function has_arquivo_processando($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo = ".$id_prospec." AND status_ren = 'PROCESSANDO'");
    $row = pg_fetch_array($number1);  
    //echo "<script>console.log('id: ".empty($row)."');</script>";      
    if($row[0] == 0)
      return false;
    else
      return true;
  }

  function has_arquivo_com_erro($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo = ".$id_prospec." AND status_ren = 'ERROR'");
    $row = pg_fetch_array($number1);        
    if($row[0] == 0)
      return false;
    else
        return true;
  }

?>