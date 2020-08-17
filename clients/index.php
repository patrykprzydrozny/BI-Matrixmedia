<head>

<link rel="stylesheet" href="assets/css/login2.scss">
<link rel="stylesheet" href="assets/css/style2.scss">
</head>

<?php 

session_start();

include 'php_db.php';

if(isset($_SESSION['use'])) 
{
    header("Location:panel.php"); 
 }

?>

 <div class="wrapper">

<form method="post" class="login">

		<h1 class="topOfTheTop">Panel admina</h1>       

			<input class="" type="text" name="username" id="username" value="" autocomplete="off" placeholder = "Username" autofocus/>

				<i class="fa fa-user"></i>

			<input type="password" name="password" id="password" value="" autocomplete="off" placeholder = "Password" />

				<i class="fa fa-key"></i>

    



         <input class="button" type="submit" name="submitBtnLogin" id="submitBtnLogin" value="Zaloguj" />

       



  

<?php

$msg = ""; 

if(isset($_POST['submitBtnLogin'])) 

	{

		$username = trim($_POST['username']);

		$password = trim($_POST['password']);
	

		if($username != "" && $password != "") 

			

			{

			try 

				{	
					$conn = connect_db();
					$sql = "SELECT password FROM USERS WHERE LOGIN = '$username'";
					$stmt = $conn->query($sql);
					$stmt->execute();
					$hash = $stmt->fetch();
					$passver = password_verify($password, $hash["password"]);					
					if($passver > 0) 

						{
							echo $passver;
							$_SESSION['use']=$username;
							header('location:panel.php');	
						} 

					else 

						{	echo $passver;
							$msg = "Niepoprawny login lub hasło";
							echo '<span class="error">'.$msg.'</span>';
						}

				} 

			catch (PDOException $e) 

				{

					echo "Error : ".$e->getMessage();

				}

			} 

		else 

			{


		}

	}

?>