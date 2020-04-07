<?php
 
// Include Composer autoloader if not already done.
include 'pdfparser/vendor/autoload.php';
 
// Parse pdf file and build necessary objects.
$parser = new \Smalot\PdfParser\Parser();
$pdf    = $parser->parseFile('pdfparser/working2050.pdf');
 
// Retrieve all pages from the pdf file.
$pages  = $pdf->getPages();

$myfile = fopen("newfile.txt", "w") or die("Unable to open file!");
 
// Loop over each page to extract text.
foreach ($pages as $page) {
    echo $page->getText();
    fwrite($myfile, $page->getText());
}

fclose($myfile);
 
?>