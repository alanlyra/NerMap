
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

        <form action="text_to_conll.php" method="post">
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
        func2();
        func3();
    }
    function func1()
    {
        $str=file_get_contents('texto.txt');
        $str=str_replace(" ", "\r\n",$str);
        file_put_contents('texto2.txt', $str);
    }
    function func2()
    {
        $str=file_get_contents('texto2.txt');
        $str=str_replace("/", " ",$str);
        file_put_contents('texto2.txt', $str);
    }
    function func3()
    {
        $str=file_get_contents('texto2.txt');
        $str=str_replace("\r\n\r\n", "\r\n",$str);
        file_put_contents('texto2.txt', $str);
    }
?>

</html>

