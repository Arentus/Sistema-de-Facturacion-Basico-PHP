<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php include_once '../class/error.php'; ?>

<?php 
	
	$tp = new Errors();
	$checklist = array('nombre' => $_POST['name']);

	$errors = $tp->comp_errores($checklist)
 ?>