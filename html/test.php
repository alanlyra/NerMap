
<html>
    <head>
        <meta charset="UTF-8">
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link href="https://fonts.googleapis.com/css?family=Anton|Roboto:300,400,700" rel="stylesheet">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<title>Dissertação</title>
        <link rel="stylesheet" type="text/css" href="/css/default.css"/>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>


<body>

		<main>
			<header class="main-header">
			        <h2 class="titulo-pagina">
					<span class="titulo-subsecao">Dissertação</span>
			        </h2>

			</header>
			<div class="container">

        <form action="test.php" method="post">
            <input type="submit" name="someAction" value="GO" />
        </form>

			</div>
		</main>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.bundle.min.js"></script>
</body>

<?php
/*
    exec('java -mx600m -cp "*:lib\*" edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier classifiers/own-ner-model.ser.gz -textFile testePPT.txt > testePPTok-taggedtest.txt');
*/
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
       error_reporting(E_ALL);

	$handle = popen('java -mx600m -cp "*:ner/lib\*" edu.stanford.nlp.ie.crf.CRFClassifier -loadClassifier ner/classifiers/own-ner-model.ser.gz -textFile testePPT.txt > testePPTok-taggedtest.txt
', 'r');
	echo "'$handle'; " . gettype($handle) . "\n";
	$read = fread($handle, 2096);
	echo $read;
	pclose($handle);
    }
?>

</html>

