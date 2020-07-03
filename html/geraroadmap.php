<?php
require_once 'system.php';
      
  if (isset($argc)) {
    for ($i = 0; $i < $argc; $i++) {
      $id = intval($argv[$i]);

      if(file_get_contents('roadmaps/' . $id . '-tagged.txt')) {

        $roadmapText = file_get_contents('roadmaps/' . $id . '-tagged.txt');

        $pieces_space_Array = explode(" ", $roadmapText);

        $palavras_array = [];
        $tags_array = [];
        $has_date = false;
        $has_temppred = false;
        $is_prospec = false;
        
        $count=0; 
        $id_arrays = 0; 
        foreach($pieces_space_Array as $value) {
          //$count++;
          $pieces_barra_Array = explode("/", $value);
          
          $stringArrayItemCount = count($pieces_barra_Array);
          $stringArrayLastItem = $pieces_barra_Array[$stringArrayItemCount-1];
          unset($pieces_barra_Array[$stringArrayItemCount-1]);
          $pieces_barra_Array = array(implode("/",$pieces_barra_Array),$stringArrayLastItem);

          //Verifica ocorrencia de trechos taggeados e adiciona nas tabelas TEXTO e REN

          $palavras_array[$id_arrays] = $pieces_barra_Array[0];
          $tags_array[$id_arrays] = $pieces_barra_Array[1];
          $id_arrays++;

          if($pieces_barra_Array[1] != "O" && $pieces_barra_Array[1] != "" && $pieces_barra_Array[1] != null) {

            if($pieces_barra_Array[1] == "DATE") {
              if($pieces_barra_Array[0] != "today" && $pieces_barra_Array[0] != "now" && $pieces_barra_Array[0] != "right") {
                $has_date = true;
              }
            }
            if($pieces_barra_Array[1] == "U_TEMPPRED" || $pieces_barra_Array[1] == "B_TEMPPRED" || $pieces_barra_Array[1] == "M_TEMPPRED" || $pieces_barra_Array[1] == "E_TEMPPRED") {
              if($pieces_barra_Array[0] != "today") {
                $has_temppred = true;
              }
            }
        
        }

        if($has_date && $has_temppred)
          $is_prospec = true;

          if($pieces_barra_Array[0] == ".") {
            if($is_prospec){
              
              for ($j = 0; $j < sizeof($palavras_array); $j++) {
                $count++;
                if($palavras_array[$j] !== null)
                  $set_on_texto = set_data("INSERT INTO texto (id_texto, ordem, palavra) VALUES (".$id.", ".$count.", '".$palavras_array[$j]."');");
                if($tags_array[$j] !== null)
                  $set_on_texto = set_data("INSERT INTO ren (id_ren, tag, ordem_texto) VALUES (".$id.", '".$tags_array[$j]."', ".$count.");");           
              }
            
            }
            $palavras_array = [];
            $tags_array = [];
            $id_arrays = 0;
            $has_date = false;
            $has_temppred = false;
            $is_prospec = false;
          }

          
          
        //Adiciona nas tabelas TEXTO e REN sem verificação de termos taggeados
        /*  if($pieces_barra_Array[0] !== null)
                $set_on_texto = set_data("INSERT INTO texto (id_texto, ordem, palavra) VALUES ($1, $2, $3);", array($id, $count, $pieces_barra_Array[0]));
          if($pieces_barra_Array[1] !== null)
                $set_on_texto = set_data("INSERT INTO ren (id_ren, tag, ordem_texto) VALUES ($1, $2, $3);", array($id, $pieces_barra_Array[1], $count));*/
        }  

        $number = get_data("SELECT id_prospec_arquivo from arquivos where id_arquivo = $1", array($id));
        $row = pg_fetch_array($number);        
        $id_prospec = $row[0];
        
        $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'CONCLUIDO' where id_arquivo = $1", array($id));

        if(has_arquivo_processando($id_prospec))
          $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'PROCESSANDO' where id_prospec = $1", array($id_prospec));
        else if (has_arquivo_com_erro($id_prospec))
          $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'ERROR' where id_prospec = $1", array($id_prospec));
        else
          $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($id_prospec));

        //Nao remover mais, pois agora o roadmap é concatenado
      //remove_roadmap_completo_antigo($id_prospec);
      }
      else {
        $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'ERROR' where id_arquivo = $1", array($id));
        $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'ERROR' where id_prospec = $1", array($id_prospec));
      }
    }
  }
  else {
    echo "argc and argv disabled\n";
  }    


  function has_arquivo_processando($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo = ".$id_prospec." AND status_ren = 'PROCESSANDO'");
    $row = pg_fetch_array($number1);        
    if($row[0] == 0)
      return false;
    else
        return true;
  }

  function has_arquivo_com_erro($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo = ".$id_prospec." AND status_ren = 'ERROR'");
    $row = pg_fetch_array($number1);        
    if($row[0] == 0)
      return false;
    else
        return true;
  }

  function remove_roadmap_completo_antigo($id_prospec) {   
    get_data("DELETE FROM roadmap WHERE id_prospec_roadmap = ".$id_prospec." AND id_arquivo_unico IS NULL");
  }
    
?>