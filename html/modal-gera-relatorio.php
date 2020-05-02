<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];


      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>Gerar Relatório</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<div class='row justify-content-center'>
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                  <img src='img/csv.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>CSV</h4>
                    <p>Relatório do roadmap em formato CSV.</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorio();'><i class='fas fa-download fa-sm text-white-50'></i>    Baixar</button>
                  </div>
                </div> <!-- End Col -->
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/pdf.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>PDF</h4>
                    <p>Relatório do roadmap em formato PDF.</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorio();'><i class='fas fa-download fa-sm text-white-50'></i>    Baixar</button>
                  </div>
                </div> <!-- End Col -->	
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/txt.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>TEXTO</h4>
                    <p>Relatório do roadmap em formato TXT.</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorio();'><i class='fas fa-download fa-sm text-white-50'></i>    Baixar</button>
                  </div>
                </div> <!-- End Col -->	
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/json.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>JSON</h4>
                    <p>Relatório do roadmap em formato JSON.</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraJSONdownload();'><i class='fas fa-download fa-sm text-white-50'></i>    Baixar</button>
                  </div>
                </div> <!-- End Col -->	
          </div>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

  ?>

 






