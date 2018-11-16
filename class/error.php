<?php  
	class Errors{
		private $errors = array();
		
		public function check_errors($checklist){

			$errors = array();

			foreach ($checklist as $key => $value) {
				if (!empty($value)) {
					$error = $this->filter_value($key,$value);
					if ($error) {
						$errors[] = $error;
					}
				}else{
					$errors[] = 'Sorry, The Field  : [ '.$key.' ] is Blank.';
				}
			}
			
			return $this->errors = $errors;
		}

		public function filter_value($value_type,$val){

			switch ($value_type) {
				case 'name':
					if (!$this->check_name($val)) {
						return $val.' It\'s not a valid Name.';
					}	
					break;
				case 'first_name':
					if (!$this->check_name($val)) {
						return $val.' It\'s not a valid Name.';
					}	
					break;
				case 'sur_name':
					if (!$this->check_name($val)) {
						return $val.' It\'s not a valid Name.';
					}	
					break;
				case 'dni':
					if (!$this->check_dni($val)) {
						return $val.' It\'s not a valid DNI.';
					}	
					break;
				case 'alphadni':
				if (!$this->check_alphadni($val)) {
					return $val.' It\'s not a valid DNI.';
				}	
				break;
				case 'email' : 
					if (!$this->check_email($val)) {
						return $val.' It\'s not a valid Email.';
					}
					break;
				default:
					break;
			}
		}

	
		public function check_name($name){
			return preg_match('/^[a-zA-Z].*[\s\.]*$/', $name);
		}

		public function check_email($email){
			return filter_var($email, FILTER_VALIDATE_EMAIL);
		}
		public function check_dni($dni){
			return preg_match('/^[a-zA-Z0-9_.-]*$/',$dni);
		}
		public function check_alphadni($dni){
			return preg_match('/^[a-zA-Z0-9_.-]*$/',$dni);
		}
		public function is_presence($data){
			if (isset($data) && !empty($data)) {
				return true;
			}
		}
		public function arrDataExists($checklist,$table='user'){
			
			$errors = array();

			foreach ($checklist as $key => $value) {
				if (!$this->dataExists($key,$value,$table)) {
					$errors[] = 'Su ['.$key.'] esta en uso. :( ';
				}
			}
			return $this->errors = $errors;
		}
		public function dataExists($data_type,$data,$table='user'){

			try{
							
				$db_conexion = getDB();
				
				if (!$nRows = $db_conexion->query("SELECT * FROM ".$table." WHERE ".$data_type."='".$data."';")->fetchColumn()) {
					return true;
				}else{
					return false;
				}

			}catch(PDOException $e){
				return "Erorr comprobando ".$table." : ".$e->getMessage();
			}
				
		}	

	}
	
?>