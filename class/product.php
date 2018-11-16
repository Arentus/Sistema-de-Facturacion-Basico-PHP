<?php 

class Product {

	private $name = 'name';
	private $description = 'descripcion';
	private $category = 'category';
	private $prize = 'prize';
	private $stock = 'stok';
	private $db;
	private $table;

	public function __construct(){
		$this->db = getDB();
		$this->table = 'product';
		$this->name = 'name';
		$this->description = 'descripcion';
		$this->category = 'id_category';
		$this->id_product = 'id_product';
		$this->prize = 'prize';
		$this->stock = 'stok';
	}
	
	public function createProduct($name,$description,$id_category,$prize,$stock=0){
		try{

			$statement = $this->db->prepare("INSERT INTO ".$this->table." (".$this->name.",".$this->descripcion.",".$this->category.",".$this->prize.",".$this->stock.") VALUES (:name,:description,:id_category,:prize ,:stock )");

			$statement->bindParam(':name',$name,PDO::PARAM_STR);
			$statement->bindParam(':description',$description,PDO::PARAM_STR);
			$statement->bindParam(':id_category',$id_category,PDO::PARAM_STR);
			$statement->bindParam(':prize',$prize,PDO::PARAM_STR);
			$statement->bindParam(':stock',$stock,PDO::PARAM_STR);

			$statement->execute();

			$this->db = null;
			return true;
		}catch(PDOException $e){

			$this->db = null;
			return "[ErrorProduct] not added : " . $e->getMessage();
		}

	}
	public function gett(){
		return true;
	}
	public function editProduct($id_product,$name,$description,$id_category,$prize,$stock){
		try{

			$statement = $this->db->prepare("UPDATE ".$this->table." SET ".$this->name." = :name , description = :description , id_category = :id_category, prize = :prize, stock = :stock WHERE id_product = :id_product ");

			$statement->bindParam(':name',$name,PDO::PARAM_STR);
			$statement->bindParam(':description',$description,PDO::PARAM_STR);
			$statement->bindParam(':id_category',$id_category,PDO::PARAM_STR);
			$statement->bindParam(':prize',$prize,PDO::PARAM_STR);
			$statement->bindParam(':stock',$stock,PDO::PARAM_STR);
			$statement->bindParam(':id_product',$id_product,PDO::PARAM_STR);

			$statement->execute();

			$this->db = null;
			return true;
		}catch(PDOException $e){

			$this->db = null;
			return "product no agregado" . $e->getMessage();
		}
	}

	public function deleteProduct($id){
		try{
			
				$result = $this->db->query("DELETE FROM product WHERE id_product = ".$id." LIMIT 1");

				return true;
			
		}catch(PDOException $e){
			$this->db = null;
			return "[ErrorProduct] Not Deleted : ".$e->getMessage();
		}

	}
	public function getAllProducts($offset=0,$rowsPerPage = N_productS_BYPAGE,$id=''){ /* work in this*/
		try{
		
			//necesitas una funcion que reciba un id si es todos los products de una category en especifico, también debe manejar el offset y el rowsPerPage de la paginación 

			if (!empty($id)) {
				$result = $this->db->query('SELECT product.id_product, product.name AS product_name, product.description, category.name AS name_category,  product.prize,product.stock FROM product INNER JOIN category ON category.id_category = product.id_category WHERE product.id_category = '.$id.'  ORDER BY product.id_category ASC LIMIT '.$offset. ', '.$rowsPerPage);
			}else{
				$result = $this->db->query('SELECT product.id_product, product.name AS product_name, product.description, category.name AS name_category,  product.prize,product.stock FROM product INNER JOIN category ON category.id_category = product.id_category WHERE product.id_category = category.id_category ORDER BY product.id_category ASC LIMIT '.$offset. ', '.$rowsPerPage);
			}

			if ($result->rowCount() > 0) {
				
				return $result;
			}
			
		}catch(PDOException $e){

			$this->db = null;
			return "Error getting products : ".$e->getMessage();
		}
	}
	

}
