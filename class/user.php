<?php 
$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}db.php");

class User{
	public $nombre;
	private $correo;
	private $password;
	private $direccion;

	public static function user_is_loggedin(){
		if (!empty($_SESSION['user_id'])) {
			header('Location: '.BASE_URL.'home');
		}
	}

	public function log_in($data,$password){

		try{

			$db = getDB();	

			$hashed_password = hash('sha256',$password);
			
			$stmt = $db->prepare("SELECT * FROM usuario WHERE (nombre=:data OR correo=:data) AND password=:hashed_password");

			$stmt->bindParam(":data",$data,PDO::PARAM_STR);
			$stmt->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);

			$stmt->execute();

			$count = $stmt->rowCount();
			$user_data = $stmt->fetch(PDO::FETCH_OBJ);
			$db = null;

			var_dump($user_data);
			
			if ($count) {
				$_SESSION['user_data'] = $user_data;
				$_SESSION['user_id'] = $user_data->id;
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
			$db_conexion = getDB();
			
			$stmt = $db_conexion->prepare("SELECT * FROM usuario WHERE nombre=:name");
			
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo "Erorr comprobando usuario : ".$e->getMessage();
		}

	}

	public function create_user($nombre,$correo,$password,$role=1,$direccion){
		
		try{

			$db_conexion  = getDB();
			
			$statement = $db_conexion->prepare("SELECT id FROM usuario WHERE correo=:correo"); 

			$statement->bindParam(":correo", $correo,PDO::PARAM_STR);
			
			$statement->execute();

			$count=$statement->rowCount();

			if($count<1) { /* usuario no registrado en base de datos */

				$statement = $db_conexion ->prepare("INSERT INTO usuario (nombre,correo,password,role,direccion) VALUES (:nombre,:correo,:hashed_password,:role,:direccion)");

				$statement->bindParam(":nombre",$nombre,PDO::PARAM_STR);
				$statement->bindParam(":correo",$correo,PDO::PARAM_STR);
				$statement->bindParam(":role",$role,PDO::PARAM_INT);
				$hashed_password = hash('sha256',$password);
				$statement->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);
				$statement->bindParam(":direccion",$direccion,PDO::PARAM_STR);
				
				$statement->execute();

				$user_id = $db_conexion->lastInsertId();	

				$_SESSION['user_id'] = $user_id;

				$db_conexion =null; /* se cierra la conexion*/
				return $user_id;

			}else{
	
				$db_conexion  = null; /* se cierra la conexion */
				return false;
			}

		}catch(PDOException $e){

			echo 'Error registrando usuario: '.$e->getMessage();
		}

	}


}

?>