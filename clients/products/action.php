<?php

//action.php

include '../php_db.php';
function ChangeToInt($tmp){
	return intval($tmp);
}

function editcol () {
		$query = 
		"Update PRODUCTS_DATA Set Name = '".$_POST["Name"]."', Weight =".$_POST["Weight"].", Rule ='".$_POST["Rule"]."' WHERE Id = ".$_POST["Id"].";  ";
		if($_POST['Supplier']) {
				$secondquery = "UPDATE PRODUCTS_PRICES INNER JOIN PRODUCTS_DATA ON PRODUCTS_PRICES.EAN = PRODUCTS_DATA.EAN SET PRODUCTS_PRICES.Supplier = '".$_POST["Supplier"]."'";
				$finalquery = $query.''.$secondquery;

			echo $finalquery;
			return $finalquery;
		}

		else{
			
			return $finalquery = $query ;
		}
	
}


function deletecol () {
	
		$query = "
		DELETE FROM PRODUCTS_DATA
		WHERE Id = ".$_POST["Id"]."
		";
		return $query;
}


function goQuery ($query){
	$connect = connect_db();
	$statement = $connect->prepare($query);
	if($statement->execute()){
		return true;
		$statement = NULL;
	}
	else {
		return false;
	}
}

if($_POST['action'] == 'edit'){
	$tmp = editcol();
	goQuery($tmp, $connect);

}

if($_POST['action'] == 'delete'){
	$tmp = deletecol();
	goQuery($tmp, $connect);	
	}
?>