<?php include 'pdfparser/vendor/autoload.php'; ?>

<script src="vendor/jquery/jquery.min.js"></script>

<?php

  $newname = $_POST["param"];

  $pieces_newname = explode(".", $newname);

  $stringArrayItemCount = count($pieces_newname);
  $stringArrayLastItem = $pieces_newname[$stringArrayItemCount-1];
  unset($pieces_newname[$stringArrayItemCount-1]);
  $pieces_newname = array(implode(".",$pieces_newname),$stringArrayLastItem);

  $namefile = $pieces_newname[0];
  $extfile = $pieces_newname[1];

  if($extfile == "pdf") {
    $newname_txt = str_replace(".pdf", ".txt", $newname);
    $parser = new \Smalot\PdfParser\Parser();
    $pdf    = $parser->parseFile('uploads/pdf/'.$newname);
      
    // Retrieve all pages from the pdf file.
    $pages  = $pdf->getPages();

    $pdfUploaded = fopen("uploads/".$newname_txt, "w") or die("Unable to open file!");
      
    // Loop over each page to extract text.
    foreach ($pages as $page) {
      fwrite($pdfUploaded, $page->getText());
    }

    fclose($pdf_uploaded);
  }

  if(file_get_contents('uploads/' . $namefile . '.txt')) {
    //Roda o script de bash
    run_ner(intval($namefile));
  }
  else  {
    $update_on_arquivo = set_data("UPDATE arquivos SET status_ren = 'ERROR' where id_arquivo = $1", array(intval($namefile)));
  }

  function run_ner($id_run) {   
    $id_arquivo = $id_run;
    $num_textos = 1;
  
    popen("bash /home/alan/NerMap/html/process_input.sh " . $id_arquivo . " " . $num_textos, "r");
  }

  ?>