<?php
function connect_db()
{
    try
    {
        $connection = new PDO('mysql:host=59765.m.tld.pl;dbname=baza59765_bi_matrixmedia', 'admin59765_bi_matrixmedia','4Vj!OYLWCd');
		return $connection;
    }
    catch (PDOException $e)
    {
        // Proccess error
        echo 'Cannot connect to database: ' . $e->getMessage();
    }
}
?>