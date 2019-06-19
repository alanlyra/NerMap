<?php
require_once 'system.php';
      
  if (isset($argc)) {
    for ($i = 0; $i < $argc; $i++) {
      //echo "Argument #" . $i . " - " . $argv[$i] . "\n";
      $id = intval($argv[$i]);
      $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($id));
    }
  }
  else {
    echo "argc and argv disabled\n";
  }    
    
?>