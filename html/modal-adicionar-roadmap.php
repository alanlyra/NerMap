<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];
      $cabecalho = $_POST["cabecalho"];
      $id_arquivo = $_POST["idArquivoRoadmap"];
      $assuntoAdd = $_POST["assunto"];

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
                    <input type='text' id='anoProspec' name='anoProspec' value='' placeholder='Ano da prospecção...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')'>
                  </div>
                  </br>
                  <div class='col-xl-9 col-lg-10s'>
                   <h5>Prospecção:</h5>
                    <input type='text' id='infoProspec' name='infoProspec' value='' placeholder='Acontecimento...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2'>
                  </div>
                 </br>
                 <div class='col-xl-9 col-lg-10s'>
                   <h5>Fonte:</h5>
                    <input type='text' id='nomeArquivoAdicionado' name='nomeArquivoAdicionado' value='' placeholder='Título da fonte...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2'>
                  </div>
                 </br>
                 <div class='col-xl-9 col-lg-10s'>
                   <h5>Ano de Publicação:</h5>
                    <input type='text' id='anoArquivoAdicionado' name='anoArquivoAdicionado' value='' placeholder='Ano da fonte...' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2'>
                  </div>
                 </br>

                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='cabecalhoCompleto' name='cabecalhoCompleto' class='form-control bg-light border-0 small' value='".$cabecalhoCompleto."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='keyConsulta' name='keyConsulta' class='form-control bg-light border-0 small' value='".$keyConsulta."'  aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

                <input type='text' id='assuntoAdd' name='assuntoAdd' class='form-control bg-light border-0 small' value='".$assuntoAdd."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>
             
                <div class='py-3' style='text-align: center;'>
                
                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarAdicionarRoadmap' value='Adicionar' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

  ?>

 






