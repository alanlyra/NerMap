<?php
require_once 'system.php';
require_once 'vendor/autoload.php';
?>

<?php

  //Passo 3
  //Disparar processamento (reusar funções existentes)

  $basefolder = "/home/alan/NerMap/html/uploads/";

  //Pegando o primeiro da fila para ser processado
  $getData = get_data("SELECT id_arquivo, id_prospec_arquivo FROM arquivos where status_ren = 'FILA' limit 1");
  $row = pg_fetch_array($getData);        
  $idArquivo = $row[0];
  $idProspecArquivo = $row[1];   

  //Seta processando no arquivo
  $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'PROCESSANDO' where id_arquivo = $1", array($idArquivo));
    
  //Processa documento PDF para TXT
  use Spatie\PdfToText\Pdf;



  if(file_exists($basefolder."pdf/" .$idArquivo. ".pdf")) {

    $pdfUploaded = fopen($basefolder.$idArquivo. ".txt", "w") or die("Unable to open file!");

    $path = '/usr/bin/pdftotext';
    $text = (new Pdf($path))
        ->setPdf($basefolder.'pdf/'.$idArquivo. ".pdf")
        ->text();

    fwrite($pdfUploaded, $text);

    fclose($pdfUploaded);
  }
  else {
    print_r("Arquivo uploads/pdf/" .$idArquivo. ".pdf não existe.");
  }

  if(file_get_contents($basefolder . $idArquivo . '.txt')) {
    //Roda o script de bash
    run_ner(intval($idArquivo));
  }
  else  {
    $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'ERROR' where id_arquivo = $1", array(intval($idArquivo)));
  }

  function run_ner($id_run) {   
    $id_arquivo = $id_run;
    $num_textos = 1;

    popen("bash echo 'Iniciando processamento do arquivo: '".$id_arquivo." >> /home/alan/NerMap/html/logbulk.txt", "r");

    popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos. " >> /home/alan/NerMap/html/logbulk.txt", "r");

    popen("bash echo 'Finalizado processo do arquivo: '".$id_arquivo." >> /home/alan/NerMap/html/logbulk.txt", "r");

  }

?>
