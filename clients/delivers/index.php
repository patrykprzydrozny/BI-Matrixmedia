<?php
session_start();
include 'SendQuery.php';
if ( isset( $_SESSION['use'] ) ) {
    ?>
<head>
  <meta charset="UTF-8">
  <title>Projekt SNMP</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
    <script>
        function typeDeliver(NameT) {
            if (NameT == "") {
                document.getElementById("CourierType").innerHTML = "";
                return;
            } else {
                var xmlhttp = new XMLHttpRequest();
                xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                        document.getElementById("CourierType").innerHTML = this.responseText;
                    }
                };
            xmlhttp.open("GET","typeDeliver.php?NameT="+NameT,true);
            xmlhttp.send();
            }
    }
function searchPrice(NameT, type_deliver, weight) {
    if (NameT == "" || type_deliver == "" || weight == "") {
	    document.getElementById("freeDeliver").innerHTML = "Uzupełnij wszystkie dane";
	    return;
    }
    else {
	    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
                document.getElementById("freeDeliver").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","SearchPrice.php?NameT="+NameT+"&type_deliver="+type_deliver+"&weight="+weight,true);
        xmlhttp.send();
        }
    }
    </script>
</head>
<body>
	<div class="container">
	    <input data-function="swipe" id="swipe" type="checkbox">
	    <label data-function="swipe" for="swipe">&#xf057;</label>
	    <label data-function="swipe" for="swipe">&#xf0c9;</label>
	        <div class="headings">
		        <div id = "resrooom">
			        <form name="rsvroom" method="GET">
			        <?php
                    $status = SendQuery("SELECT distinct nazwa_dostawcy as name FROM DELIVERS");
				    echo 'Rodzaj Kuriera:';	?>
				    <select class="form-control form-control-sm" name="nazwa_dostawy" id="nazwa_dostawy" onclick ="typeDeliver(this.value)">
				    <option disabled selected value style="display:none"> Wybierz kuriera </option>
		        <?php
				while($row = $status->fetch())
					{ ?>
						<option value="<?php echo $row['name']?>"><?php echo $row['name']?></option>;
				<?php } ?>
				</select>
				<div id="CourierType"></div>
				<div>
				Waga w kg :
				<input type="number" id="weight" name="weight" min="0.1" max="500"  value="Waga w kg">
				</div>
				<input class="form-control form-control-sm" type="button" onclick="searchPrice(document.getElementById('nazwa_dostawy').value,document.getElementById('type_deliver').value,document.getElementById('weight').value )" value="Licz">
			</form>
			<div id="freeDeliver"></div>
		</div>
  </div>
<div class="sidebar">
	<nav class="menu">
	<li><a href="products">Magazyn Produktów</a></li>
    <li><a href="">Allegro</a></li>
    <li><a href="">Sklep</a></li>
	<li><a href="">Zmień Hasło</a></li>
	<li><a href="">Wróć</a></li>
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