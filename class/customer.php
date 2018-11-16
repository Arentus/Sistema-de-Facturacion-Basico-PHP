<?php 

/*
| Author : Robwert Mota 
| Clase Customer [Cliente] posee todoso los comportamientos y propiedades pertinetes 
| a los clientes.
*/

class Customer{

	// it's possible to assing 'alphadni' that allows numbers, dashes, points underscore and letters

	private $customer_Fields = ['dni', 'dni_type','first_name','sur_name','email', 'country','sex','birthdate','state', 'address'
	];

	private $db;
	private $table;

	public function __construct(){
		$this->db = getDB();
		$this->table = 'customer'; 
	}

	public function createCustomer($datos){
		
		try{
			$i = 1;
			$tokens = $this->get_tokens();
			$values = $this->get_values();

			$statement = $this->db->prepare("INSERT INTO ".$this->table." (".$values.") VALUES (".$tokens.")");

			
			$statement->bindParam(":dni_type",$datos['dni_type'],PDO::PARAM_STR);
			$statement->bindParam(":dni",$datos['dni'],PDO::PARAM_STR);
			
			$statement->bindParam(":first_name",$datos['first_name'],PDO::PARAM_STR);
			$statement->bindParam(":sur_name",$datos['sur_name'],PDO::PARAM_STR);
			$statement->bindParam(":email",$datos['email'],PDO::PARAM_STR);
			$statement->bindParam(":country",$datos['country'],PDO::PARAM_STR);
			$statement->bindParam(":sex",$datos['sex'],PDO::PARAM_STR);
			$statement->bindParam(":birthdate",$datos['birthdate'],PDO::PARAM_STR);
			$statement->bindParam(":state",$datos['state'],PDO::PARAM_STR);
			$statement->bindParam(":address",$datos['address'],PDO::PARAM_STR);
			
			$statement->execute();
			
			return true;
			$this->db =null; /* se cierra la conexion*/

		}catch(PDOException $e){

			echo '[CustomError] Custom Not Created : '.$e->getMessage();
		}

	}

	public function get_values(){
			$i = 1;
			$values = '';
			foreach ($this->customer_Fields as $value) {	// Datos del modelo
				if (sizeof($this->customer_Fields) == $i) {
					$values .= $value; 

				}else{
					$values .= $value.","; 
				}

				$i++;
			}
			return $values;
	}

	public function get_tokens(){
			$i = 1;
			$tokens = '';
			foreach ($this->customer_Fields as $value) {	// Datos del modelo
				if (sizeof($this->customer_Fields) == $i) {
					$tokens .= ":".$value; 

				}else{
					$tokens .= ":".$value.","; 
				}

				$i++;
			}
		return $tokens;
	}
	/*-------------------------
	| Metodos Getters y Setters
	|	[Customer]
	----------------------------*/


	public function getTableName(){
		return $this->table;
	}

	public function getCustomerFields(){
		return $this->customer_Fields;
	}
}

?>