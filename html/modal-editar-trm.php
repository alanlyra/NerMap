<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];
      $nome_trm = $_POST["nometrm"];
      $tema_trm = $_POST["tematrm"];
      $ano_trm = $_POST["anotrm"];

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Editar informações do TRM</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<form action='prospeccoes.php?' method='post' multipart='' enctype='multipart/form-data'>
                
                  <div class='col-xl-12 col-lg-12'>
                  <h5>Ano:</h5>
                    <input type='text' id='anoProspec' name='nomeProspec' value='".$nome_trm."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' required>
                  </div>
                  </br>
                  <div class='col-xl-6 col-lg-7'>
                  <h5>Área:</h5>
                    <select type='text' id='temaRoadmap' name='temaProspec' class='form-control' style='cursor: pointer;' required>
                      <option id='option-Educação' value='Educação'>Educação</option>
                      <option id='option-Medicina' value='Medicina'>Medicina</option>
                      <option id='option-Transporte' value='Transporte'>Transporte</option>
                      <option id='option-Trabalho' value='Trabalho'>Trabalho</option>
                    </select>
                  </div>
                  </br>
                   <div class='col-xl-6 col-lg-7'>
                  <h5>Ano limite do TRM:</h5>
                    <input type='text' id='anoProspec' name='anoProspec' value='".$ano_trm."' class='form-control bg-light border-0 small' aria-label='Search' aria-describedby='basic-addon2' onkeyup='this.value=this.value.replace(/[^\d]/,'')' required>
                  </div>
                  </br>

                <input type='text' id='idRoadmap' name='idRoadmap' class='form-control bg-light border-0 small' value='".$id_roadmap."' aria-label='Search' aria-describedby='basic-addon2' style='display: none; visibility: hidden;'>

               
             
                <div class='py-3' style='text-align: center;'>
                
                <button class='btn btn-danger btn-icon-split' type='submit' name='deletarProspeccaoRoadmap' value='Remover' style='width: 8em; height: 2em; display: inline-block;'><i class='fas fa-trash fa-sm text-white-50'></i>     Remover</button>

                <input class='btn btn-primary btn-icon-split' type='submit' name='salvarEdicaoTRM' value='Salvar' style='width: 8em; height: 2em; display: inline-block;' />

                  </br>
                </div>

              </form>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

  ?>

  <script>

    var tema_trm_JS = "<?php echo $tema_trm; ?>";
    document.getElementById("option-"+tema_trm_JS).selected = true;

  </script>

 





