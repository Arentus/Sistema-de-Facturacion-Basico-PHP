<?php 

class User{

	private $nombre;
	private $correo;
	private $password;
	private $direccion;
	private $db;
	private $table;

	public function __construct(){
		$this->db = getDB();
		$this->table = 'usuario';
	}

	public static function userIsAuth(){
		if (!isset($_SESSION)) {
			session_start();
		}
		if (isset($_SESSION['user_data'])) {
			return true;
		}
	}

	public function log_in($data,$password){

		try{

			$hashed_password = hash('sha256',$password);
			
			$stmt = $this->db->prepare("SELECT * FROM usuario WHERE (nombre=:data OR correo=:data) AND password=:hashed_password");

			$stmt->bindParam(":data",$data,PDO::PARAM_STR);
			$stmt->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);
			$stmt->execute();

			$count = $stmt->rowCount();
			$user_data = $stmt->fetch(PDO::FETCH_OBJ);
			$this->db = null;

			var_dump($user_data);
			
			if ($count) {
				$_SESSION['user_data'] = $user_data;
				return true;

			}else{
				return false;
			}
		}catch(PDOException $e){
			echo "Error iniciando sesión ".$e->getMessage();
		}
	}

	public function username_exists($name){
		try{
			
			$stmt = $this->db->prepare("SELECT * FROM usuario WHERE nombre=:name");
			
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo "Erorr comprobando usuario : ".$e->getMessage();
		}

	}

	public function create_user($nombre,$correo,$password,$role=2,$direccion){
		
		try{

			$statement = $this->db->prepare("SELECT id FROM usuario WHERE correo=:correo"); 

			$statement->bindParam(":correo", $correo,PDO::PARAM_STR);
			
			$statement->execute();

			$count=$statement->rowCount();

			if($count<1) { /* usuario no registrado en base de datos */

				$statement = $this->db->prepare("INSERT INTO usuario (nombre,correo,password,role,direccion) VALUES (:nombre,:correo,:hashed_password,:role,:direccion)");

				$statement->bindParam(":nombre",$nombre,PDO::PARAM_STR);
				$statement->bindParam(":correo",$correo,PDO::PARAM_STR);
				$statement->bindParam(":role",$role,PDO::PARAM_INT);
				$hashed_password = hash('sha256',$password);
				$statement->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);
				$statement->bindParam(":direccion",$direccion,PDO::PARAM_STR);
				
				$statement->execute();

				$user_id = $this->db->lastInsertId();	

				$_SESSION['user_id'] = $user_id;

				$this->db =null; /* se cierra la conexion*/
				return $user_id;

			}else{
	
				$this->db  = null; /* se cierra la conexion */
				return false;
			}

		}catch(PDOException $e){

			echo 'Error registrando usuario: '.$e->getMessage();
		}

	}


}

?>