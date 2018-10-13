<?php  
	class Errors{
		private $errors = array();
		
		public function comp_errores($checklist){

			$errors = array();

			foreach ($checklist as $key => $value) {
				if (!empty($value)) {
					$error = $this->filtrar_valor($key,$value);
					if ($error) {
						$errors[] = $error;
					}
				}else{
					$errors[] = 'Lo siento, Debe ingresar el campo : [ '.$key.' ]';
				}
			}
			
			return $this->errors = $errors;
		}

		public function filtrar_valor($value_type,$val){

			switch ($value_type) {
				case 'nombre':
					if (!$this->check_name($val)) {
						return 'El nombre '.$val.' no es valido';
					}	
					break;
				case 'correo' : 
					if (!$this->check_email($val)) {
						return 'El correo ingresado no es valido.';
					}
					break;
				default:
					break;
			}
		}

	
		public function check_name($name){
			return preg_match('/^[A-Za-z][A-Za-z0-9]{5,31}$/', $name);
		}

		public function check_email($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		
		public function is_presence($data){
			if (isset($data) && !empty($data)) {
				return true;
			}
		}

		public function dataExists($data_type,$data){
					switch ($data_type) {
					case 'nombre':
						try{
							
							$db_conexion = getDB();
							
							if (!$nRows = $db_conexion->query("SELECT * FROM usuario WHERE nombre='".$data."';")->fetchColumn()) {

								return 'true';
							}else{
								return 'false';
							}

						}catch(PDOException $e){
							return "Erorr comprobando usuario : ".$e->getMessage();
						}
						break;
					
					case 'correo':
					try{
			
							$db_conexion = getDB();
							
							if (!$nRows = $db_conexion->query("SELECT * FROM usuario WHERE correo='".$data."';")->fetchColumn()) {
								return 'true';
							}else{
								return 'false';
							}

						}catch(PDOException $e){
							return "Erorr comprobando usuario : ".$e->getMessage();
						}
					default:
						# code...
						break;
			}
				
		}


	}
	
?>