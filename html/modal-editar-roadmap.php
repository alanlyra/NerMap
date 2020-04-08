<?php
require_once 'system.php';
require_once 'checklogin.php';
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
              <h4 class='modal-title'>Editar Prospecção</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='seeroadmap.php?".$cabecalho."=".$param."' method='post' multipart='' enctype='multipart/form-data'>
                
                   <div class='col-xl-6 col-lg-7'>
                  <h5>Ano:</h5>
                    <input type='text' id='anoProspec' name='anoProspec' value='".$date_roadmap."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')'>
                  </div>
                  </br>
                  <div class='col-xl-9 col-lg-10s'>
                   <h5>Prospecção:</h5>
                    <input type='text' id='infoProspec' name='infoProspec' value='".$info_roadmap."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2'>
                  </div>
                 </br>

                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='indiceRoadmap' name='indiceRoadmap' class='form-control bg-light border-0 small' value='".$indice_roadmap."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='cabecalhoCompleto' name='cabecalhoCompleto' class='form-control bg-light border-0 small' value='".$cabecalhoCompleto."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='keyConsulta' name='keyConsulta' class='form-control bg-light border-0 small' value='".$keyConsulta."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
             
                <div class='py-3' style='text-align: center;'>
                <button class='btn btn-secondary btn-icon-split' type='submit' name='deletarProspeccaoRoadmap' value='Remover' style='width: 8em; height: 2em; display: inline-block;'><i class='fas fa-trash fa-sm text-white-50'></i>     Remover</button>
                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoRoadmap' value='Salvar' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

  ?>

 






