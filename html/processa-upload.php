<?php
require_once 'system.php';
?>

<script>
  function init_process(id_arquivo) {
    $.ajax({
      url: "init_process_input.php",
      method: "POST",
      data: { "id-arquivo": id_arquivo }
    });
  }
</script>

<?php

  $id_fle = $argv[1];
  $call_type = $argv[2];
  
  if($call_type == "pdf" || $ext == ".pdf" || $ext == "PDF" || $ext == ".PDF") {

  }  
  if(isset($_POST["adicionarArquivo"])) {
    
    $file = $_FILES['files'];;
    $ano = $_POST['anoArquivo'];
    $nome = $_POST['nomeArquivo'];
    $conf_value = $_POST['rate'];
    $identificador = $_POST['identificador'];

    if($identificador) {
      if(!empty($file))
      {
        if(!$nome == "" && !$conf_value == "" && !$ano == "") {
            //echo "<script>console.log( 'Confiabilidade: " . $conf_value . "' );</script>";
            //echo "<script>console.log( 'Ano: " . $ano . "' );</script>";
            
            $id_arquivo = get_max_id_arquivo();
            //echo "<script>console.log( 'ID ARQUIVO: " . $id_arquivo . "' );</script>";
            $file_desc = reArrayFiles($file);
            //print_r($file_desc);
            $num_textos = 0;
            
            foreach($file_desc as $val)
            {
              //$newname = date('YmdHis',time()).mt_rand().'.jpg';
              $newname = get_max_id_arquivo();
              if($num_textos > 0) {
                $newname .= "_";
                $other_text = $num_textos + 1;
                $newname .= $other_text;
              }
              $newname .= ".txt";

              $ext = pathinfo($val['name'], PATHINFO_EXTENSION);  

              if($ext == "pdf" || $ext == ".pdf" || $ext == "PDF" || $ext == ".PDF") {
                $parser = new \Smalot\PdfParser\Parser();
                $pdf    = $parser->parseFile($val['tmp_name']);
                 
                // Retrieve all pages from the pdf file.
                $pages  = $pdf->getPages();

                $pdfUploaded = fopen("uploads/".$newname, "w") or die("Unable to open file!");
                 
                // Loop over each page to extract text.
                foreach ($pages as $page) {
                    fwrite($pdfUploaded, $page->getText());
                }

                fclose($pdf_uploaded);

                $newname_pdf = str_replace(".txt", ".pdf", $newname);
                move_uploaded_file($val['tmp_name'],'uploads/pdf/'.$newname_pdf);
              }
              else
                move_uploaded_file($val['tmp_name'],'uploads/'.$newname);	
              
              $num_textos++;          
            }
            
            db_arquivo($id_arquivo, $conf_value, $ano, "PROCESSANDO", $nome, $identificador);
            $num_arquivos = get_num_arquivos_on_prospec($identificador);
            db_prospec($identificador, $num_arquivos);


            //popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos, "r");
            }
        else{
          //echo "<script>console.log( 'Deu ruim!!' );</script>";
        }
      }
    }
  }



  function reArrayFiles($file)
  {
      $file_ary = array();
      $file_count = count($file['name']);
      $file_key = array_keys($file);
      
      for($i=0;$i<$file_count;$i++)
      {
          foreach($file_key as $val)
          {
              $file_ary[$i][$val] = $file[$val][$i];
          }
      }
      return $file_ary;
  }

  function get_max_id_arquivo() {   
    $number1 = get_data("select MAX(id_arquivo) from arquivos");
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $number = $number2 + 1;

        return $number;
  }

  function get_num_arquivos_on_prospec($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo =".$id_prospec);
    $row = pg_fetch_array($number1);        
    $number = $row[0]; 

        return $number;
  }

  function db_arquivo($id_arquivo_db, $conf_value_db, $ano_db, $status_ren_db, $nome_arquivo_db, $identificador_db) {   
      $save_on_arquivos = set_data("INSERT INTO arquivos (id_arquivo, nome_arquivo, ano_arquivo, autores_arquivo, conf_arquivo, id_prospec_arquivo, status_ren, usuario_arquivo) VALUES ($1, $2, $3, $4, $5, $6, $7, $8)", array($id_arquivo_db, $nome_arquivo_db, $ano_db, 1, $conf_value_db, $identificador_db, 'PROCESSANDO', $_SESSION['id']));
      echo "<script>init_process(".$id_arquivo_db.");</script>"; 
    }

  function db_prospec($id_prospec_db, $num_arquivos_db) {   
    $save_on_prospec = set_data("UPDATE prospec SET num_textos_prospec = ".$num_arquivos_db." WHERE id_prospec = ".$id_prospec_db);
    $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'PROCESSANDO' where id_prospec = $1", array($id_prospec_db));
    //echo "<script>reloadtable();</script>";
    echo "<script>window.location.href = 'prospeccoes.php';</script>";
  }
?>

<?php
	$number3 = get_data("SELECT id_prospec FROM prospec WHERE usuario_prospec = '".$_SESSION['id']."'");
    $row3 = pg_fetch_all($number3);

    for($j=0; $j < sizeof($row3); $j++) {
    	if(has_arquivo_processando($row3[$j][id_prospec]))
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'PROCESSANDO' where id_prospec = $1", array($row3[$j][id_prospec]));
    	else if (has_arquivo_com_erro($row3[$j][id_prospec]))
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'ERROR' where id_prospec = $1", array($row3[$j][id_prospec]));
    	else
      	$update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'CONCLUIDO' where id_prospec = $1", array($row3[$j][id_prospec]));
      //echo "<script>reloadtable();</script>";
    } 


    function has_arquivo_processando($id_prospec) {   
    $number1 = get_data("SELECT COUNT(*) FROM arquivos WHERE id_prospec_arquivo = ".$id_prospec." AND status_ren = 'PROCESSANDO'");
    $row = pg_fetch_array($number1);  
    //echo "<script>console.log('id: ".empty($row)."');</script>";      
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

?>