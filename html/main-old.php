<?php
require_once 'system.php';
require_once 'checklogin.php';
saveCurrentURL();
?>

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




<?php


function showTexto() {

    $query_results=get_data('SELECT texto.palavra FROM texto WHERE texto.id_texto = 1');

    $results_max = pg_num_rows($query_results);

    if  ($results_max>0) {
        while($result=pg_fetch_object($query_results)){

           
            echo '<p> '.$result->palavra.'</p><br>';
        }
    }
}

    ?>





<body onload="javascript:onLoad()">

	<div class="site">
		<header class="l-cabecalho">
				
 				
		</header>

		<main>
			<header class="main-header">
			        <h2 class="titulo-pagina">
				 
					<span class="titulo-subsecao">Prospecções</span>
<?php showTexto() ?>

<p></p>
			        </h2>
				
			</header>
			<div class="container">
				
		
				


			</div>
		</main>

		<footer class="l-footer">
      	<span class="versao-sistema">  </span>
      
    </footer>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.bundle.min.js"></script>
</body>





 <script>
	


function onLoad(){

	

	}
	

  </script>
    

</html>
