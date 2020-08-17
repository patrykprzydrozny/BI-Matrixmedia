<?php 
include 'php_db.php';

$email = $_REQUEST["email"];

	$conn = connect_db();
	$sql = "SELECT count(*) as chk FROM USERS WHERE email = '$email'";
	$stmt = $conn->query($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	
	if($result["chk"] == 1) {
	echo "Email zajêty";
	}else{
		echo "";
	};

?>