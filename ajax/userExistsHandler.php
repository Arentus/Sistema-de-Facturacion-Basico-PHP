<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php 
	
		if (isset($_POST['name']) && !empty($_POST['name'])) {
			$username = $_POST['name'];
			if (strlen($username) >= 4) {

					try{
					
					$db_conexion = getDB();
					
					if (!$nRows = $db_conexion->query("SELECT * FROM usuario WHERE nombre='".$username."';")->fetchColumn()) {

						echo '<div class="alert alert-success">El usuario esta disponible!</div>';
					}else{
						echo '<div class="alert alert-danger">El usuario se encuentra en uso. Por favor elija otro.</div>';
					}

				}catch(PDOException $e){
					echo "Erorr comprobando usuario : ".$e->getMessage();
				}
			}else{
				echo '<div class="alert alert-danger">El nombre debe ser mayor que 4 caracteres.</div>';
			}
	
		}
 ?>
	