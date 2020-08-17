<?php
include 'php_db.php';

//add user
if(!empty($_POST['add_user'])) { 
	$login = $_POST['login'];
	$password = $_POST['password'];
	$first_name = $_POST['fname'];
	$last_name = $_POST['lname'];
	$email = $_POST['email'];
	add_user($login,$password,$first_name,$last_name,$email);
} 

function add_user($login,$password,$first_name,$last_name,$email)
{
	$conn = connect_db();
	$sql = "SELECT count(*) as chk FROM USERS WHERE LOGIN = '$login' OR EMAIL = '$email'";
	$stmt = $conn->query($sql);
	$stmt->execute();
	$result = $stmt->fetch();
	if( $result["chk"] == 0 ){
	$password_hash	= password_hash($password, PASSWORD_DEFAULT);
		
	$sql = "INSERT INTO USERS (login,password,first_name,last_name,email)
		   VALUES ('".$login."','".$password_hash."','".$first_name."','".$last_name."','".$email."')";
	$conn->query($sql);	
	header("Location: http://bi.matrixmedia.pl/clients");

	};
}

//delete_user
if(isset($_POST['del_user'])){
$login = $_POST['login'];
delete_user($login);
}
function delete_user($login){	
	$sql = "DELETE FROM users WHERE login = '".$login."'";
	$conn->query($sql);
}


//update_user
function update_user($column,$param,$login)
{
	$sql = "UPDATE users SET ".$column." = ".$param." WHERE login = '".$login."'"; 
	$conn->query($sql);
}

if(!empty($_POST['logg_in'])) { 
	$login = $_POST['loginn'];
	$password = $_POST['passwordd'];
	login($login,$password);
} 




?>

