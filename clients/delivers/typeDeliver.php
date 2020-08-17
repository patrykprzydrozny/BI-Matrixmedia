<?php
include 'SendQuery.php';
$nazwa_dostawy = $_GET['NameT'];
?>
<?php
$status = SendQuery("SELECT DISTINCT rodzaj_dostawy as type_deliver FROM DELIVERS WHERE nazwa_dostawcy ='".$nazwa_dostawy."'");
echo 'Rodzaj  wysyłki:'; ?>		
<select class="form-control form-control-sm" name="type_deliver" id="type_deliver">
<option disabled selected value style="display:none"> Wybierz rodzaj przesyłki </option>
<?php while($row = $status->fetch()) { ?>
	<option value="<?php echo $row['type_deliver']?>"><?php echo $row['type_deliver']?></option>
<?php } ?>
</select>


