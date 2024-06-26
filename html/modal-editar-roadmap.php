<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_arquivo = $_POST["identificador"];
      $indice_roadmap = $_POST["indice"];
      $date_roadmap = $_POST["date"];
      $info_roadmap = $_POST["info"];
      $cabecalho = $_POST["cabecalho"];
      $id_roadmap = $_POST["prospec"];

      $nome1 = get_data("SELECT nome_arquivo FROM arquivos WHERE id_arquivo =".$id_arquivo);
      $row = pg_fetch_array($nome1);        
      $nome_arquivo = $row[0];    

      if($cabecalho == "arquivo") {
        $param = $id_arquivo;
        $keyConsulta = "id_arquivo_unico";
      }
      else {
        $param = $id_roadmap;
        $keyConsulta = "arquivo_origem";
      }

      $cabecalhoCompleto = $cabecalho."=".$param;



      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$LANG['136']."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div id='content-teste' class='modal-body'>";

        echo "<form action='roadmaps.php?".$cabecalho."=".$param."' method='post' multipart='' enctype='multipart/form-data'>
                
                   <div class='col-xl-6 col-lg-7'>
                  <h5>".$LANG['21'].":</h5>
                    <input type='text' id='anoProspec' name='anoProspec' value='".$date_roadmap."' placeholder='".$LANG['147']."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required>
                  </div>
                  </br>
                  <div class='col-xl-12 col-lg-12'>
                   <h5>".$LANG['144'].":</h5>
                    <textarea rows='6' type='text' id='infoProspec' name='infoProspec' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>".$info_roadmap."</textarea>
                  </div>
                 </br>

                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='indiceRoadmap' name='indiceRoadmap' class='form-control bg-light border-0 small' value='".$indice_roadmap."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='cabecalhoCompleto' name='cabecalhoCompleto' class='form-control bg-light border-0 small' value='".$cabecalhoCompleto."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='keyConsulta' name='keyConsulta' class='form-control bg-light border-0 small' value='".$keyConsulta."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
             
                <div class='py-3' style='text-align: center;'>
                  <a href='#' data-target='#modalConfirmarDeleteProspeccao' data-toggle='modal' data-id='deleteprospeccao-".$id_roadmap."' data-arquivo='".$id_arquivo."' data-ano='".$date_roadmap."' data-info='".$info_roadmap."' data-indice='".$indice_roadmap."' data-cabecalho='".$cabecalhoCompleto."' data-keyconsulta='".$keyConsulta."' style='display: inline-block; margin-left:3px;'><button class='btn btn-danger btn-icon-split' value='Remover' style='width: 8em; height: 2em; display: inline-block;'><i class='fas fa-trash fa-sm text-white-50'></i>     ".$LANG['101']."</button></a>

                  <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoRoadmap' value='".$LANG['103']."' style='width: 8em; height: 2em; display: inline-block;' />

                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>".$LANG['79']."</button>
            </div>
          </div>";

  ?>

  <!-- Confirma Remoção do TRM Modal-->
  <div class="modal fade" id="modalConfirmarDeleteProspeccao" role="dialog" style="top: 15vh;">
    <div id="delete-prospeccao" class="modal-dialog" >
      
    </div>
  </div>

<script>
var data_id = '';
    $(document).ready(function() {
        $('a[data-toggle=modal], button[data-toggle=modal]').click(function () {
          
          if (typeof $(this).data('id') !== 'undefined') {
          	data_id = $(this).data('id');
          }      

          if (typeof $(this).data('arquivo') !== 'undefined') {
            data_arquivo = $(this).data('arquivo');
          }
          if (typeof $(this).data('ano') !== 'undefined') {
            data_anoarquivo = $(this).data('ano');
          }
          if (typeof $(this).data('info') !== 'undefined') {
            data_infoarquivo = $(this).data('info');
          }
          if (typeof $(this).data('indice') !== 'undefined') {
            data_indice = $(this).data('indice');
          }
          if (typeof $(this).data('cabecalho') !== 'undefined') {
            data_cabecalho = $(this).data('cabecalho');
          }
          if (typeof $(this).data('keyconsulta') !== 'undefined') {
            data_keyconsulta = $(this).data('keyconsulta');
          }
          

          var data_txt =  data_id.toString();
          var data_id_deleteprospeccao = data_txt.replace('deleteprospeccao-','');
          if (data_txt.indexOf('deleteprospeccao-') > -1) {
            $.ajax({
              url: "modal-confirma-delete-prospeccao.php",
              method: "POST",
              data: { "identificador": data_id_deleteprospeccao,
                      "arquivo": data_arquivo,
                      "ano": data_anoarquivo,
                      "info": data_infoarquivo,
                      "indice": data_indice,
                      "cabecalho": data_cabecalho,
                      "consulta": data_keyconsulta },
              success: function(html) {
                $('#delete-prospeccao').html(html);
                $('#modalConfirmarDeleteProspeccao').modal('show');
              }
            })
          }
        })
    });


</script>
 






