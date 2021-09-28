<?php
$utf8_text = iconv("ISO-8859-1", "UTF-8", $iso_8859_1_text);
?>

<?php
	include ( 'pdftotextmaster/PdfToText.phpclass' ) ;

	function  output ( $message )
	   {
		if  ( php_sapi_name ( )  ==  'cli' )
			echo ( $message ) ;
		else
			echo ( nl2br ( $message ) ) ;
	    }

	$file	=  'pdfparser/working2050' ;
	$pdf	=  new PdfToText ( "$file.pdf" ) ;

	output ( "Original file contents :\n" ) ;
	output ( file_get_contents ( "$file.txt" ) ) ;
	output ( "-----------------------------------------------------------\n" ) ;

	output ( "Extracted file contents :\n" ) ;
	output ( $pdf -> Text ) ;

  ?>