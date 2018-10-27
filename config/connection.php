<?php include_once 'db.php'; ?>

<?php 
	
	function getDB(){

		try{
			$dbConn = new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASSWORD);
			$dbConn->exec("set names utf8");
			$dbConn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $dbConn;
		}catch(PDOException $e){
			echo 'Imposible establecer la conexion : ',$e->getMessage();
			return false;
			die();
		}
	}
	
	

 ?>