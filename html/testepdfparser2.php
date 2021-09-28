<?php
	include ( 'pdftotextmaster/PdfToText.phpclass' ) ;


    $file	=  'pdfparser/working2050' ;
	$pdf	=  new PdfToText ( "$file.pdf" ) ;

	$pdfUploaded = fopen("testesdsd3ok.txt", "w") or die("Unable to open file!");
      
    fwrite($pdfUploaded, $pdf -> Text );

?>