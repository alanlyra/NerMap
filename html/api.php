<?php
require_once 'system.php';
?>

<?php

  if(isset($_GET["arquivo"]) || isset($_GET["roadmap-completo"])) {

    if(isset($_GET["roadmap-completo"])) {

      $id_roadmap = $_GET["roadmap-completo"];

      $number2 = get_data("SELECT json_api FROM api WHERE id_prospec_api =".intval($id_roadmap));
      $row1 = pg_fetch_array($number2);        
      $json_completo = $row1[0];

      header('Content-type: application/json');
      echo $json_completo;
    }
    else {
      $id_arquivo = $_GET["arquivo"];

      $number1 = get_data("SELECT id_prospec_arquivo FROM arquivos WHERE id_arquivo =".intval($id_arquivo));
      $row = pg_fetch_array($number1);        
      $id_roadmap = $row[0]; 

      $number2 = get_data("SELECT json_api FROM api WHERE id_prospec_api =".intval($id_roadmap));
      $row1 = pg_fetch_array($number2);        
      $json_completo = $row1[0];

      $array_tmp = [];
      $index_tmp = 0;    

      $json_decode_completo = json_decode($json_completo);

      foreach ($json_decode_completo as $value) {
        if($value->id_arquivo == $id_arquivo) {
          $array_tmp[$index_tmp] = $value;
          $index_tmp++;
        }
      }
      
      header('Content-type: application/json');
      echo json_encode($array_tmp);

    }
  }

?>