<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php include_once '../class/error.php'; ?>
<?php include_once '../class/product.php'; ?>

<?php 
	
		
		try{
			$product = new Product();

			$nombre = $_POST['product_name'];
			$descripcion = $_POST['product_description'];
			$id_categoria = $_POST['category_name'];
			$precio = $_POST['prize'];
			$stock = $_POST['stock'];

			echo $product->createProduct($nombre,$descripcion,$id_categoria,$precio,$stock);
			
		}catch(Exception $e){
			echo 'Nada y con error : ' .$e->getMessage();
		}
	
 ?>