<?php 

class Product {

	private $nombre;
	private $descripcion;
	private $categoria;
	private $precio;
	private $stock;
	private $db;
	private $table;

	public function __construct(){
		$this->db = getDB();
		$this->table = 'producto';
	}

	public function createProduct($nombre,$descripcion,$id_categoria,$precio,$stock=0){
		try{

			$statement = $this->db->prepare("INSERT INTO producto (nombre,descripcion,id_categoria,precio,stock) VALUES (:nombre,:descripcion,:id_categoria,:precio ,:stock )");

			$statement->bindParam(':nombre',$nombre,PDO::PARAM_STR);
			$statement->bindParam(':descripcion',$descripcion,PDO::PARAM_STR);
			$statement->bindParam(':id_categoria',$id_categoria,PDO::PARAM_STR);
			$statement->bindParam(':precio',$precio,PDO::PARAM_STR);
			$statement->bindParam(':stock',$stock,PDO::PARAM_STR);

			$statement->execute();

			$this->db = null;
			return true;
		}catch(PDOException $e){

			$this->db = null;
			return "Producto no agregado" . $e->getMessage();
		}

	}
	public function gett(){
		return true;
	}
	public function getAllProducts($offset=0,$rowsPerPage = N_PRODUCTOS_BYPAGE,$id=''){ /* work in this*/
		try{
		
			//necesitas una funcion que reciba un id si es todos los productos de una categoria en especifico, también debe manejar el offset y el rowsPerPage de la paginación 

			if (!empty($id)) {
				$result = $this->db->query('SELECT producto.id_producto, producto.nombre AS producto_nombre, producto.descripcion, categoria.nombre AS nombre_categoria,  producto.precio,producto.stock FROM producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE producto.id_categoria = '.$id.'  ORDER BY producto.id_categoria ASC LIMIT '.$offset. ', '.$rowsPerPage);
			}else{
				$result = $this->db->query('SELECT producto.id_producto, producto.nombre AS producto_nombre, producto.descripcion, categoria.nombre AS nombre_categoria,  producto.precio,producto.stock FROM producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE producto.id_categoria = categoria.id_categoria ORDER BY producto.id_categoria ASC LIMIT '.$offset. ', '.$rowsPerPage);
			}

			if ($result->rowCount() > 0) {
				
				return $result;
			}
			
		}catch(PDOException $e){

			$this->db = null;
			return "Error trayendo productos ".$e->getMessage();
		}
	}
	

}
