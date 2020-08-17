<?php
	include('../php_db.php');
	$connect = connect_db();
	$column = array("Id", "Name", "Ean", "Weight", "Rule","Supplier","Buy_Price", "Date", "Id_Products_Price");
	$query = "SELECT pd.Id as Id, pd.Name as Name, pd.Ean as Ean, pd.Weight as Weight, pd.Rule as Rule, pd.Id_Products_Price as Id_Products_Price ,pp.Buy_Price as Buy_Price, pp.Supplier as Supplier, pp.DATE as Date, pd.Id_Products_Price as Id_Products_Price FROM PRODUCTS_DATA pd LEFT JOIN PRODUCTS_PRICES pp ON pd.Ean = pp.Ean";
	if(isset($_POST["search"]["value"])){
		$query .= '
		WHERE 
		pd.Id LIKE "%'.$_POST["search"]["value"].'%"
	    OR pd.Id_Products_Price LIKE "%'.$_POST["search"]["value"].'%"
		OR pd.Name LIKE "%'.$_POST["search"]["value"].'%"
		OR pd.Ean LIKE "%'.$_POST["search"]["value"].'%"
		OR pd.Weight LIKE "%'.$_POST["search"]["value"].'%"
		OR pd.Rule LIKE "%'.$_POST["search"]["value"].'%"
		OR pp.Buy_Price LIKE "%'.$_POST["search"]["value"].'%"
		OR pp.Supplier LIKE "%'.$_POST["search"]["value"].'%"
		OR pp.Date LIKE "%'.$_POST["search"]["value"].'%"
		';
	}
	if(isset($_POST["order"])){
		$query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
	}
	else{
		$query .= 'ORDER BY Id DESC ';
	}
	$query1 = '';
	if($_POST["length"] != -1){
		$query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
	}
	$statement = $connect->prepare($query);
	$statement->execute();
	$number_filter_row = $statement->rowCount();
	$result = $statement->fetchAll();
	$data = array();
	foreach($result as $row){
		$sub_array = array();
		$sub_array[] = $row['Id'];
		$sub_array[] = $row['Name'];
		$sub_array[] = $row['Ean'];
		$sub_array[] = $row['Weight'];
		$sub_array[] = $row['Rule'];
		$sub_array[] = $row['Supplier'];
		$sub_array[] = $row['Buy_Price'];
		$sub_array[] = $row['Date'];
		$sub_array[] = $row['Id_Products_Price'];
		$data[] = $sub_array;
	}
	function count_all_data($connect){
		$query = "SELECT pd.Id as Id, pd.Name as Name, pd.Ean as Ean, pd.Weight as Weight, pd.Rule as Rule ,pp.Buy_Price as Buy_Price, pp.Supplier as Supplier, pp.DATE as Date FROM PRODUCTS_DATA pd LEFT JOIN PRODUCTS_PRICES pp ON pd.Ean = pp.Ean ";
		$statement = $connect->prepare($query);
		$statement->execute();
		return $statement->rowCount();
	}
	$output = array(
		'draw'   => intval($_POST['draw']),
		'recordsTotal' => count_all_data($connect),
		'recordsFiltered' => $number_filter_row,
		'data'   => $data
	);
	echo json_encode($output);
?>
