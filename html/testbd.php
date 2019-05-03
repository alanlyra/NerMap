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


<body>

		<main>
			<header class="main-header">
			        <h2 class="titulo-pagina">
					<span class="titulo-subsecao">Dissertação</span>
			        </h2>

			</header>
			<div class="container">

        <form action="testbd.php" method="post">
            <input type="submit" name="someAction" value="GO" />
        </form>

			</div>
		</main>

	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.bundle.min.js"></script>
</body>

<?php
    if($_SERVER['REQUEST_METHOD'] == "POST" and isset($_POST['someAction']))
    {
        func1();
    }
    function func1()
    {   
	$number1 = get_data("select MAX(audience_id) from audience");
	$row = pg_fetch_array($number1);				
	$number2 = $row[0];	
	$number = $number2 + 1;
	$number = 2;

        $save_on_prospec = set_data("INSERT INTO prospec (id_prospec, assunto_prospec, nome_prospec) VALUES ($1, 'Teste1', 'Teste1')", array($number));
    }
?>

</html>

