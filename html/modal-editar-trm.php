<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];
      $nome_trm = $_POST["nometrm"];
      $tema_trm = $_POST["tematrm"];
      $ano_trm = $_POST["anotrm"];

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$LANG['60']."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='trms.php?' method='post' multipart='' enctype='multipart/form-data'>
                
                  <div class='col-xl-12 col-lg-12'>
                  <h5>".$LANG['3'].":</h5>
                    <input type='text' id='anoProspec' name='nomeProspec' value='".$nome_trm."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                  </div>
                  </br>
                  <div class='col-xl-6 col-lg-7'>
                  <h5>".$LANG['4'].":</h5>
                    <select type='text' id='temaRoadmap' name='temaProspec' class='form-control' style='cursor: pointer;' required>
                      <option id='option-General' value='General'>".$LANG['228']."</option>
                      <option id='option-Education' value='Education'>".$LANG['17']."</option>
                      <option id='option-Medicine' value='Medicine'>".$LANG['18']."</option>
                      <option id='option-Transport' value='Transport'>".$LANG['19']."</option>
                      <option id='option-Work' value='Work'>".$LANG['20']."</option>
                    </select>
                  </div>
                  </br>
                   <div class='col-xl-6 col-lg-7'>
                  <h5>".$LANG['6'].":</h5>
                    <input type='text' id='anoProspec' name='anoProspec' value='".$ano_trm."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required>
                  </div>
                  </br>

                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

               
             
                <div class='py-3' style='text-align: center;'>
                
                <a href='#' data-target='#modalConfirmarDeleteProspec' data-toggle='modal' data-id='deleteprospec-".$id_roadmap."' style='display: inline-block; margin-left:3px;'><button class='btn btn-danger btn-icon-split' value='Remover' style='width: 8em; height: 2em; display: inline-block;'><i class='fas fa-trash fa-sm text-white-50'></i>     ".$LANG['101']."</button></a>  

                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoTRM' value='".$LANG['103']."' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>".$LANG['79']."</button>
            </div>
          </div>";

  ?>

  <!-- Confirma Remoção do TRM Modal-->
  <div class="modal fade" id="modalConfirmarDeleteProspec" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div id="delete-trm" class="modal-dialog" role="document">
      
    </div>
  </div>

  <script>

    var tema_trm_JS = "<?php echo $tema_trm; ?>";
    document.getElementById("option-"+tema_trm_JS).selected = true;

    var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }         

          var data_txt =  data_id.toString();
          var data_id_deleteprospec = data_txt.replace('deleteprospec-','');         
          if (data_txt.indexOf('deleteprospec-') > -1) {
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
          else
          	document.getElementById('identificador').value = data_id;

        })
    });

  </script>

 






