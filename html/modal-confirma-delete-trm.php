<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_prospec = $_POST["identificador"];


      echo "<div class='modal-content'>
              <div class='modal-header'>
             
                <h5 class='modal-title' id='exampleModalLabel'>Tem certeza que deseja remover o TRM?</h5>
                <button class='close' type='button' data-dismiss='modal' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>Todos os arquivos e roadmaps associados também serão removidos.</div>
              <div class='modal-footer'>
              <form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
              <input type='text' id='idProspec' name='idProspec' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <button class='btn btn-danger' type='button' data-dismiss='modal'>Voltar</button>
                <input class='btn btn-primary' type='submit' name='deleteProspec' value='Confirmar' />
                </form>
                </div>
         
           </div>'";



  ?>

<script>


</script>
 






