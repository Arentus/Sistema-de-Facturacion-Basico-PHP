<?php 
require_once '../config/connection.php';
require_once '../config/db.php';
require_once '../class/product.php';

$id_producto = $_GET['id_producto'];

$db = getDB();

try{
	if (isset($_GET['id_producto'])) {
		$result = $db->query('SELECT * FROM producto WHERE id_producto = '.$id_producto);
	
		echo json_encode($result->fetch(PDO::FETCH_OBJ));
	}

}catch(PDOException $e){
	echo 'Error obteniendo producto del ID ['.$id_producto.'] '.$e->getMessage();
}
?>