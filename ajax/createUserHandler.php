<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php include_once '../class/error.php'; ?>

<?php 

		$checklist = array(
			'nombre' => $_POST['name'],
			'correo' => $_POST['email'],
			'direccion' => $_POST['address']
		);

		$tp = new Errors();
		
		$errors = $tp->comp_errores($checklist);

		if (empty($errors)) {	

			$db = getDB();
			
			$nombre = htmlspecialchars(trim($_POST['name']));
			$correo = htmlspecialchars($_POST['email']);
			$direccion = htmlspecialchars($_POST['address']);
			$role = 2; // role de cliente
		
			$statement = $db->prepare("INSERT INTO usuario (nombre,correo,role,direccion) VALUES (:nombre,:correo,:role,:direccion)");

			$statement->bindParam(":nombre",$nombre,PDO::PARAM_STR);
			$statement->bindParam(":correo",$correo,PDO::PARAM_STR);
			$statement->bindParam(":role",$role,PDO::PARAM_INT);
			$statement->bindParam(":direccion",$direccion,PDO::PARAM_STR);
			
			$statement->execute();

			echo 'true';
		}else{
			echo json_encode($errors);
		}
?>
