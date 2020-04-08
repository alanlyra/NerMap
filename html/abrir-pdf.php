<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

  <?php 
      $id_arquivo = $_POST["identificador"];

      $nome1 = get_data("SELECT nome_arquivo FROM arquivos WHERE id_arquivo =".$id_arquivo);
      $row = pg_fetch_array($nome1);        
      $nome_arquivo = $row[0];    

      echo "<div class='modal-content'>
            <div class='modal-header'>
              <h4 class='modal-title'>".$nome_arquivo."</h4>
              <button type='button' class='close' data-dismiss='modal'>&times;</button>       
            </div>
            <div class='modal-body'>";

              if(file_exists("uploads/pdf/".$id_arquivo.".pdf")) {
                echo "<embed src='uploads/pdf/".$id_arquivo.".pdf' type='application/pdf' width='100%' height='600px' />";
              }
              else {
                echo "<div>
                <a href='/uploads/".$id_arquivo.".txt' download><div><img src='img/download.png' style='width: 20px; height: 20px; float:right;'/></a>
                <iframe src='uploads/".$id_arquivo.".txt' scrolling='auto' width='100%' height='600px'></iframe>
                </div>";
              }
             
       echo "</div>
            <div class='modal-footer'>
              <button type='button' class='btn btn-default' data-dismiss='modal'>Fechar</button>
            </div>
          </div>";

    
        
  ?>





