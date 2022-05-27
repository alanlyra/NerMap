<?php
require_once 'system.php';
?>

<?php

  use RenanBr\BibTexParser\Listener;
  use RenanBr\BibTexParser\Parser;
  use RenanBr\BibTexParser\Processor;

  require 'vendor/autoload.php';

  $identificador = $_GET["idProspec"];

  //Passo 1
  //Processar BibTex na pasta /nermap-bulk-upload

  $bulkfolder = "/nermap-bulk-upload/";

  $bibtexfiles = glob($bulkfolder."*.bib");
  foreach ($bibtexfiles as $bibtexfile) {
    $bibtex = file_get_contents($bibtexfile);
  }
  
  // Create and configure a Listener
  $listener = new Listener();
  $listener->addProcessor(new Processor\TagNameCaseProcessor(CASE_LOWER));
  // $listener->addProcessor(new Processor\NamesProcessor());
  // $listener->addProcessor(new Processor\KeywordsProcessor());
  $listener->addProcessor(new Processor\DateProcessor());
  $listener->addProcessor(new Processor\FillMissingProcessor([/* ... */]));
  $listener->addProcessor(new Processor\TrimProcessor());
  $listener->addProcessor(new Processor\UrlFromDoiProcessor());
  // $listener->addProcessor(new Processor\LatexToUnicodeProcessor());
  // ... you can append as many Processors as you want

  // Create a Parser and attach the listener
  $parser = new Parser();
  $parser->addListener($listener);

  // Parse the content, then read processed data from the Listener
  $parser->parseString($bibtex); // or parseFile('/path/to/file.bib')
  $entries = $listener->export();

  foreach($entries as $paper) {
      //print_r($entries[0]); print_r("<br>");

      $title = $paper["title"];

      $title = str_replace("{", "", $title);
      $title = str_replace("}", "", $title);
      $title = str_replace("'", "", $title);
      $title = str_replace("^", "", $title);
      $title = str_replace("~", "", $title);
      $title = str_replace("´", "", $title);
      $title = str_replace("`", "", $title);
      $title = str_replace("\"", "", $title);
      $title = str_replace("\&", "&", $title);

      print_r($title); print_r("<br>");

      $authors = $paper["author"];
      $authors = str_replace(" and", ";", $authors);

      print_r($authors); print_r("<br>");
      print_r($paper["year"]); print_r("<br>");

      $file = explode(":", $paper["file"]);

      print_r($file[0]); print_r("<br>");
      print_r($file[1]); print_r("<br>");
      print_r($file[2]); print_r("<br><br>");

      //Passo 2
      //Mover os arquivos e inserir no banco de dados (reusar funções existentes se possível)

      if($identificador) {
      
        $id_arquivo = get_max_id_arquivo();

        print_r('/nermap-bulk-upload/'.$file[1]); print_r("<br>");
        print_r('/home/alan/NerMap/html/uploads/pdf/'.$id_arquivo .'.pdf'); print_r("<br>");
  
        copy('/nermap-bulk-upload/'.$file[1],'/home/alan/NerMap/html/uploads/pdf/'.$id_arquivo .'.pdf');
                  
        db_arquivo($id_arquivo, "5", $paper["year"], "PROCESSANDO", $title, $authors, $identificador, $title);
        //$num_arquivos = get_num_arquivos_on_prospec($identificador);
        //db_prospec($identificador, $num_arquivos, $newname);
        }
    else{
      //echo "<script>console.log( 'Deu ruim!!' );</script>";
    }
  }

   //Passo 4
  //Limpar a pasta /nermap-bulk-upload

  removeDirectory($bulkfolder);

  function removeDirectory($path) {

    $files = glob($path . '/*');
    foreach ($files as $file) {
      if(is_dir($file)) {
        removeDirectory($file);
      }
      else {
        print_r("Apagando: " .$file ); print_r(" ... <br>");
        unlink($file);
      }
    }
    print_r("Apagando diretorio: " .$path ); print_r(" ... <br>");
    rmdir($path);
  
    return;
  }

  function get_max_id_arquivo() {   
    $number1 = get_data("select MAX(id_arquivo) from arquivos");
    $row = pg_fetch_array($number1);        
    $number2 = $row[0]; 
    $number = $number2 + 1;

        return $number;
  }

  function db_arquivo($id_arquivo_db, $conf_value_db, $ano_db, $status_ren_db, $nome_arquivo_db, $autores_db, $identificador_db, $newname_db) {   
    $save_on_arquivos = set_data("INSERT INTO arquivos (id_arquivo, nome_arquivo, ano_arquivo, autores_arquivo, conf_arquivo, id_prospec_arquivo, status_ren, usuario_arquivo, autores) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)", array($id_arquivo_db, $nome_arquivo_db, $ano_db, 1, $conf_value_db, $identificador_db, 'FILA', 1, $autores_db));
    //echo "<script>init_process_upload('".$newname_db."');</script>";
  }

  function db_prospec($id_prospec_db, $num_arquivos_db) {   
    $save_on_prospec = set_data("UPDATE prospec SET num_textos_prospec = ".$num_arquivos_db." WHERE id_prospec = ".$id_prospec_db);
    $update_on_prospec = set_data("UPDATE prospec SET status_ren_prospec = 'FILA' where id_prospec = $1", array($id_prospec_db));
    //echo "<script>reloadtable();</script>";
    echo "<script>window.location.href = 'trms.php';</script>";
  }
 
?>