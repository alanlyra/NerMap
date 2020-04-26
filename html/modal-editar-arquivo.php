<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_arquivo = $_POST["identificador"];
      $nome_arquivo = $_POST["nomearquivo"];
      $ano_arquivo= $_POST["anoarquivo"];
      $conf_arquivo = $_POST["confarquivo"];

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Editar informações do arquivo</h4>
              <button type='button' class='close' onclick='hideModalEdicaoArquivo();'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data'>
                
                  <div class='col-xl-12 col-lg-12'>
                  <h5>Título:</h5>
                    <input type='text' id='nomeArquivo' name='nomeArquivo' value='".$nome_arquivo."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                  </div>
                  </br>
                  <div class='col-xl-6 col-lg-7'>
                  <h5>Data:</h5>
                    <input type='text' id='anoArquivo' name='anoArquivo' value='".$ano_arquivo."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required>
                  </div>
                  </br>
                  <div class='col-xl-12 col-lg-12'>
                  <h5>Confiabilidade:</h5>
                  <div class='btn-group' data-toggle='buttons'>
                    <label class='btn btn-plain' style='cursor: pointer;'>
                      <input type='radio' name='confArquivo' id='option1' value='1' autocomplete='off' style='cursor: pointer;' required> <span class='glyphicon glyphicon-unchecked unchecked'></span> <span class='glyphicon glyphicon-check'></span>
                      <div id='divOption-1'>
                        <!-- <img src='img/conf_1.png' style='width: 40px; height: 40px;' /> -->
                        <img src='img/conf_1_bw.png' style='width: 40px; height: 40px;' />
                      </div>
                    </label>
                    <label class='btn btn-plain' style='cursor: pointer;'>
                      <input type='radio' name='confArquivo' id='option2' value='3' autocomplete='off' style='cursor: pointer;'> <span class='glyphicon glyphicon-unchecked unchecked'></span> <span class='glyphicon glyphicon-check'></span>
                      <div id='divOption-3'>
                        <!-- <img src='img/conf_3.png' style='width: 40px; height: 40px;' /> -->
                        <img src='img/conf_3_bw.png' style='width: 40px; height: 40px;' />
                      </div>
                    </label>
                    <label class='btn btn-plain' style='cursor: pointer;'>
                      <input type='radio' name='confArquivo' id='option3' value='5' autocomplete='off' style='cursor: pointer;'> <span class='glyphicon glyphicon-unchecked unchecked'></span> <span class='glyphicon glyphicon-check'></span>
                      <div id='divOption-5'>
                        <!-- <img src='img/conf_5.png' style='width: 40px; height: 40px;' /> -->
                        <img src='img/conf_5_bw.png' style='width: 40px; height: 40px;' />
                      </div>
                    </label>
                     <label class='btn btn-plain' style='cursor: pointer;'>
                      <input type='radio' name='confArquivo' id='option4' value='8' autocomplete='off' style='cursor: pointer;'> <span class='glyphicon glyphicon-unchecked unchecked'></span> <span class='glyphicon glyphicon-check'></span>
                      <div id='divOption-8'>
                        <!-- <img src='img/conf_8.png' style='width: 40px; height: 40px;' /> -->
                        <img src='img/conf_8_bw.png' style='width: 40px; height: 40px;' />
                      </div>
                    </label>
                     <label class='btn btn-plain' style='cursor: pointer;'>
                      <input type='radio' name='confArquivo' id='option5' value='10' autocomplete='off' style='cursor: pointer;'> <span class='glyphicon glyphicon-unchecked unchecked'></span> <span class='glyphicon glyphicon-check'></span>
                      <div id='divOption-10'>
                        <!-- <img src='img/conf_10.png' style='width: 40px; height: 40px;' /> -->
                        <img src='img/conf_10_bw.png' style='width: 40px; height: 40px;' />
                      </div>
                    </label>
                  </div>
                </div>
                  </br>
                   

                <input type='text' id='idArquivo' name='idArquivo' class='form-control bg-light border-0 small' value='".$id_arquivo."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

               
             
                <div class='py-3' style='text-align: center;'>
                
                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoArquivo' value='Salvar' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' onclick='hideModalEdicaoArquivo();'>Fechar</button>
            </div>
          </div>";

  ?>

  <script>

    function hideModalEdicaoArquivo() {
      $('#modalEditarArquivo').modal('hide');
    }

    var conf_arquivo_JS = "<?php echo $conf_arquivo; ?>";
    document.getElementById("divOption-"+conf_arquivo_JS).click();

  </script>






