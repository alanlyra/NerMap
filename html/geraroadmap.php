<?php
require_once 'system.php';
      
  if (isset($argc)) {
    for ($i = 0; $i < $argc; $i++) {
      $id = intval($argv[$i]);

      $roadmapText = file_get_contents('roadmaps/' . $id . '-tagged.txt');

      $pieces_space_Array = explode(" ", $roadmapText);

      $fp = fopen('testes.txt', 'w');
      
      $count=0;  
      foreach($pieces_space_Array as $value) {
        $count++;
        //fwrite($fp, $value);
        $pieces_barra_Array = explode("/", $value);
        //fwrite($fp, $pieces_barra_Array[0]);
        if($pieces_barra_Array[0] !== null)
              $set_on_texto = set_data("INSERT INTO texto (id_texto, ordem, palavra) VALUES ($1, $2, $3);", array($id, $count, $pieces_barra_Array[0]));
        if($pieces_barra_Array[1] !== null)
              $set_on_texto = set_data("INSERT INTO ren (id_ren, tag, ordem_texto) VALUES ($1, $2, $3);", array($id, $pieces_barra_Array[1], $count));
      }  

       //fclose($fp);

      $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($id));

    }
  }
  else {
    echo "argc and argv disabled\n";
  }    
    
?>