<?php
require_once 'system.php';
require_once 'checklogin.php';
require_once 'lang.php';
saveCurrentURL();
?>

  <?php 
      $id_roadmap = $_POST["identificador"];


      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$LANG['148']."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

        echo "<div class='row justify-content-center'>
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                  <img src='img/csv.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['149']."</h4>
                    <p>".$LANG['150']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorioCSV();'><i class='fas fa-download fa-sm text-white-50'></i>    ".$LANG['161']."</button>
                  </div>
                </div> <!-- End Col -->
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/pdf.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['151']."</h4>
                    <p>".$LANG['152']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorioPDF();'><i class='fas fa-download fa-sm text-white-50'></i>    ".$LANG['161']."</button>
                  </div>
                </div> <!-- End Col -->	
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/txt.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['153']."</h4>
                    <p>".$LANG['154']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorioTXT();'><i class='fas fa-download fa-sm text-white-50'></i>    ".$LANG['161']."</button>
                  </div>
                </div> <!-- End Col -->
          </div>";

          echo "<div class='row justify-content-center'>
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/doc.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['155']."</h4>
                    <p>".$LANG['156']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorioDOC();'><i class='fas fa-download fa-sm text-white-50'></i>    ".$LANG['161']."</button>
                  </div>
                </div> <!-- End Col -->
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/json.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['157']."</h4>
                    <p>".$LANG['158']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='geraRelatorioJSON();'><i class='fas fa-download fa-sm text-white-50'></i>    ".$LANG['161']."</button>
                  </div>
                </div> <!-- End Col -->
                <div class='col-sm-6 col-md-3'>
                  <div class='col-md-12 feature-box'>
                    <img src='img/api6.png' style='width: 100px; height: 100px; display: inline-block;'/>
                    <h4>".$LANG['159']."</h4>
                    <p>".$LANG['160']."</p>
                    <button class='btn btn-primary' style='margin:5px;' onclick='visualizarAPI();'>".$LANG['162']."</button>
                  </div>
                </div> <!-- End Col -->	
          </div>";
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>".$LANG['79']."</button>
            </div>
          </div>";

  ?>

 






