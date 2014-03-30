<?php 	
	try
	{
	 $db_conn = new PDO('mysql:host=DB_SERVER; dbname=DB_NAME', DB_USER, DB_PASS);
	}
	catch(PDOException $e)
	{
	echo $e->getMessage;
	}
	?>
