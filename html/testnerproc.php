<?php

if (isset($argc)) {
	for ($i = 0; $i < $argc; $i++) {
		echo "Argument #" . $i . " - " . $argv[$i] . "\n";
		shell_exec("java -mx600m -cp '*:lib\*' edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile uploads/" . $argv[$i] . ".txt > roadmaps/". $argv[$i] . "-tagged.txt");
	}
}
else {
	echo "argc and argv disabled\n";
}


/*if (isset($argc)) {
	for ($i = 0; $i < $argc; $i++) {
		echo "Argument #" . $i . " - " . $argv[$i] . "\n";
	}
}
else {
	echo "argc and argv disabled\n";


}*/
?>