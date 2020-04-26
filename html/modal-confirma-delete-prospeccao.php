<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_prospec = $_POST["identificador"];
      $id_arquivo = $_POST["arquivo"];
      $ano_arquivo = $_POST["ano"];
      $info_arquivo = $_POST["info"];
      $indice = $_POST["indice"];
      $cabecalho = $_POST["cabecalho"];
      $keyconsulta = $_POST["consulta"];


      echo "<div class='modal-content'>
              <div class='modal-header'>
             
                <h5 class='modal-title' id='exampleModalLabel'>Tem certeza que deseja remover a prospecção?</h5>
                <button type='button' class='close' onclick='hideModalConfirmaDeleteProspeccao();'> 
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>Edições dessa prospecção também serão removidas</div>
              <div class='modal-footer'>
              <form action='seeroadmap.php?".$cabecalho."' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='anoProspec' name='anoProspec' class='form-control bg-light border-0 small' value='".$ano_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='infoProspec' name='infoProspec' class='form-control bg-light border-0 small' value='".$info_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='indiceRoadmap' name='indiceRoadmap' class='form-control bg-light border-0 small' value='".$indice."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='cabecalhoCompleto' name='cabecalhoCompleto' class='form-control bg-light border-0 small' value='".$cabecalho."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='keyConsulta' name='keyConsulta' class='form-control bg-light border-0 small' value='".$keyconsulta."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <button class='btn btn-danger' type='button' onclick='hideModalConfirmaDeleteProspeccao();'>Voltar</button>
                <input class='btn btn-primary' type='submit' name='deletarProspeccaoRoadmap' value='Confirmar' />
                </form>
                </div>
         
           </div>'";



  ?>

<script>

    function hideModalConfirmaDeleteProspeccao() {
      $('#modalConfirmarDeleteProspeccao').modal('hide');
    }

  </script>
 






