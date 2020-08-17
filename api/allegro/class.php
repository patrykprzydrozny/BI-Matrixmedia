<?php
interface iConnection 
	{
		const HOST = "localhost";
		const PORT = "22";
		const USERNAME = "uSERNAME";
		const PASSWORD = "PASSWORD";
		const DATABASE = "DATABASE";

		function linkDB();
	}
class ControlerConnect implements iConnection 
	{
		private $host = iConnection::HOST;
		private $port = iConnection::PORT;
		private $username = iConnection::USERNAME;
		private $password = iConnection::PASSWORD;
		private $database = iConnection::DATABASE;
	
		function linkDb()
		{
				try 
					{
						$pdo = new PDO (
						'mysql:host'.$this->host.';dbname'.$this->database,
						$this->username,
						$this->password);
						echo "Connect Succesful";
					}
				catch(PDOException $error)
					{
					echo $error->GetMessage();
					}
		}
	
	}
$connect = new ControlerConnect();
$connect->linkDb();	
	
	


	?>