<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_prospec = $_POST["identificador"];


      echo "<div class='modal-content'>
              <div class='modal-header'>
             
                <h5 class='modal-title' id='exampleModalLabel'>Bulk Process in TRM</h5>
                <button class='close' type='button' onclick='hideModalConfirmaBulkProcess();' aria-label='Close'>
                  <span aria-hidden='true'>×</span>
                </button>
              </div>
              <div class='modal-body'>All data in folder will be processed to compose this TRM.</div>
              <div class='modal-footer'>
              <form action='trms.php?' method='post' multipart='' enctype='multipart/form-data' style='display: inline-block;'>
              <input type='text' id='idProspec' name='idProspec' class='form-control bg-light border-0 small' value='".$id_prospec."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
                <button class='btn btn-danger' type='button' onclick='hideModalConfirmaBulkProcess();'>".$LANG['106']."</button>
                <input class='btn btn-primary' type='submit' name='bulkProcess' value='".$LANG['107']."' />
                </form>
                </div>
         
           </div>'";



  ?>

<script>

function hideModalConfirmaBulkProcess() {
      $('#modalConfirmarBulkProcess').modal('hide');
    }


</script>
 






