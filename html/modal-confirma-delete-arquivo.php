<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_prospec = $_POST["identificador"];
      $id_arquivo = $_POST["arquivo"];


      echo "<div class='modal-content'>
              <div class='modal-header'>
             
                <h5 class='modal-title' id='exampleModalLabel'>Tem certeza que deseja remover o arquivo?</h5>
                <button type='button' class='close' onclick='hideModalConfirmaDeleteArquivo();'> 
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>O roadmap do arquivo e todas as referências no roadmap do TRM também serão removidos</div>
              <div class='modal-footer'>
              <form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
                <input type='text' id='idProspec' name='idProspec' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <button class='btn btn-danger' type='button' onclick='hideModalConfirmaDeleteArquivo();'>Voltar</button>
                <input class='btn btn-primary' type='submit' name='deleteArquivo' value='Confirmar' />
                </form>
                </div>
         
           </div>'";



  ?>

<script>

    function hideModalConfirmaDeleteArquivo() {
      $('#modalConfirmarDeleteArquivo').modal('hide');
    }

  </script>
 






