<?php

require_once 'vendor/autoload.php';

use Spatie\PdfToText\Pdf;

$path = '/usr/bin/pdftotext';
$text = (new Pdf($path))
    ->setPdf('book.pdf')
    ->text();

	$pdfUploaded = fopen("testbook2.txt", "w") or die("Unable to open file!");
      
    fwrite($pdfUploaded, $text );
?>