<?php 

$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}db.php");

class Category{

	private $nombre;
	private $descripcion;
	private $db;
	private $tabla = 'categoria';

	public function __construct($tabla = 'categoria'){

		$this->tabla = 'categoria';
		$this->db = getDB();
	}

	public function add_category($name,$description){
		
		try{

			$stmt = $this->db->prepare("INSERT INTO ".$this->tabla." (nombre,descripcion) VALUES (:name, :description );");
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);
			$stmt->bindParam(":description",$description,PDO::PARAM_STR);

			$stmt->execute();

			return true;
		}catch(PDOException $e){
			return "Categoria no agreada ".$e->getMessage();
		}	
	}

	// puede que esto no sea necesario ... 
	public function get_category($id){
		try{

			$stmt = $this->db->prepare("SELECT nombre FROM ".$this->tabla." WHERE id_categoria = :id");

			$stmt->bindParam(":id",$id,PDO::PARAM_STR);
			$stmt->execute();

			return true;
		}catch(PDOException $e){
			return "Categoria no agreada ".$e->getMessage();
		}
	}

}