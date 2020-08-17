<?php 
include 'php_db.php';

$login = $_REQUEST["login"];

	$conn = connect_db();
	$sql = "SELECT count(*) as chk FROM USERS WHERE LOGIN = '$login'";
	$stmt = $conn->query($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	
	if($result["chk"] == 1) {
	echo "Login zajęty";
	}else{
		echo "";
	};

?>