<?php
session_start();
if ( isset( $_SESSION['use'] ) ) 
	{
?>
<head>
  <meta charset="UTF-8">
  <title>Bi | MatrixMedia</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
</head>
<body>
	<div class="container">
	<input data-function="swipe" id="swipe" type="checkbox">
	<label data-function="swipe" for="swipe">&#xf057;</label>
	<label data-function="swipe" for="swipe">&#xf0c9;</label>
	<div class="headings">
	</div>
		<div class="sidebar">
			<nav class="menu">	
			<li><a href="products">Magazyn Produktów</a></li>
			<li><a href="">Allegro</a></li>
			<li><a href="">Sklep</a></li>  
			<li><a href="">Zmień Hasło</a></li>
			<li><a href="">Oblicz cenę wysyłki</a></li>	   
			<li><a href="">Wyloguj</a></li>
			</nav>
		</div>
	</div>
</body>

</html>
<?php	
	} 
else 
	{ 
		header('location:index.php');
	}

?>