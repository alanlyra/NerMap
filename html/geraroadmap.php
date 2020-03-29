<?php
require_once 'system.php';
      
  if (isset($argc)) {
    for ($i = 0; $i < $argc; $i++) {
      $id = intval($argv[$i]);

      $roadmapText = file_get_contents('roadmaps/' . $id . '-tagged.txt');

      $pieces_space_Array = explode(" ", $roadmapText);
      
      $count=0;  
      foreach($pieces_space_Array as $value) {
        $count++;
        $pieces_barra_Array = 
        $pieces_barra_Array = explode("/", $value);
        
        $stringArrayItemCount = count($pieces_barra_Array);
        $stringArrayLastItem = $pieces_barra_Array[$stringArrayItemCount-1];
        unset($pieces_barra_Array[$stringArrayItemCount-1]);
        $pieces_barra_Array = array(implode("/",$pieces_barra_Array),$stringArrayLastItem);

        if($pieces_barra_Array[0] !== null)
              $set_on_texto = set_data("INSERT INTO texto (id_texto, ordem, palavra) VALUES ($1, $2, $3);", array($id, $count, $pieces_barra_Array[0]));
        if($pieces_barra_Array[1] !== null)
              $set_on_texto = set_data("INSERT INTO ren (id_ren, tag, ordem_texto) VALUES ($1, $2, $3);", array($id, $pieces_barra_Array[1], $count));
      }  

      $number = get_data("SELECT id_prospec_arquivo from arquivos where id_arquivo = $1", array($id));
      $row = pg_fetch_array($number);        
      $id_prospec = $row[0];
       
      $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'CONCLUIDO' where id_arquivo = $1", array($id));

      $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($id_prospec));

    }
  }
  else {
    echo "argc and argv disabled\n";
  }    
    
?>