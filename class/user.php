<?php 

class User{

	private $name;
	private $email;
	private $password;
	private $addres;
	private $db;
	private $table;

	public function __construct(){
		$this->db = getDB();
		$this->table = 'user';
	}

	public static function userIsAuth(){
		if (!isset($_SESSION)) {
			session_start();
		}
		if (isset($_SESSION['user_data'])) {
			return true;
		}
	}
	public static function redir_signin(){
		header('Location: inicio');

	    $_SESSION['message'] = 'Parece que necesitas iniciar sesión antes de continuar...  ';
	    die();
	}
	public function log_in($data,$password){

		try{

			$hashed_password = hash('sha256',$password);
			
			$stmt = $this->db->prepare("SELECT * FROM ".$this->table." WHERE (name=:data OR email=:data) AND password=:hashed_password");

			$stmt->bindParam(":data",$data,PDO::PARAM_STR);
			$stmt->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);
			$stmt->execute();

			$count = $stmt->rowCount();
			$user_data = $stmt->fetch(PDO::FETCH_OBJ);
			$this->db = null;

			if ($count) {
				$_SESSION['user_data'] = $user_data;
				return true;

			}else{
				return false;
			}
		}catch(PDOException $e){
			echo "[UserError] : Error SignIn ".$e->getMessage();
		}
	}

	public function username_exists($name){
		try{
			
			$stmt = $this->db->prepare("SELECT * FROM ".$this->table." WHERE name=:name");
			
			$stmt->bindParam(":name",$name,PDO::PARAM_STR);

			$stmt->execute();

			return $stmt->fetchAll(PDO::FETCH_ASSOC);
			
		}catch(PDOException $e){
			echo "[UserError] usernam cannot be checked if exits : ".$e->getMessage();
		}

	}

	public function create_user($name,$email,$password,$role=2){
		
		try{

			$statement = $this->db->prepare("SELECT id FROM ".$this->table." WHERE email=:email"); 

			$statement->bindParam(":email", $email,PDO::PARAM_STR);
			
			$statement->execute();

			$count=$statement->rowCount();

			if($count<1) { /* user no registrado en base de datos */

				$statement = $this->db->prepare("INSERT INTO ".$this->table." (name,email,password,role) VALUES (:name,:email,:hashed_password,:role)");

				$statement->bindParam(":name",$name,PDO::PARAM_STR);
				$statement->bindParam(":email",$email,PDO::PARAM_STR);
				$statement->bindParam(":role",$role,PDO::PARAM_INT);
				$hashed_password = hash('sha256',$password);
				$statement->bindParam(":hashed_password",$hashed_password,PDO::PARAM_STR);
				
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

			echo '[UserError] Not Posible to Sign Up : '.$e->getMessage();
		}

	}

}

?>