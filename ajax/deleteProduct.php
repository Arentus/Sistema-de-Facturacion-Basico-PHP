<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php include_once '../class/error.php'; ?>
<?php include_once '../class/product.php'; ?>

<?php 
		
	try{
		$product = new Product();
		$id_producto = $_POST['id_producto'];

		echo $product->deleteProduct($id_producto);
		
	}catch(Exception $e){
		echo 'Nada y con error : ' .$e->getMessage();
	}
	
 ?>