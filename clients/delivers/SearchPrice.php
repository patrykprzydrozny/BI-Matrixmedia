<?php
	include 'SendQuery.php';
	$nazwa_dostawy = $_GET['NameT'];
	$typ_dostawy = $_GET['type_deliver'];
	$waga = $_GET['weight'];
    $status = SendQuery("SELECT cena FROM DELIVERS WHERE nazwa_dostawcy = '".$nazwa_dostawy."' AND rodzaj_dostawy = '".$typ_dostawy."' AND waga >= ".$waga." ORDER BY cena ASC LIMIT 1");
	while($row = $status->fetch()) { ?>
		<div id="pricecost">
		<p class="priceinfo">Cena wysyłki Twojej Paczki</p><p class="priceprice"><?php echo $row['cena']?> zł</p>
	<?php } ?>
	<div>

	
	
 