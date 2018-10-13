<?php include_once '../config/connection.php'; ?>
<?php include_once '../config/db.php'; ?>
<?php include_once '../class/error.php'; ?>

<?php 

	$tp = new Errors();

	$res = $tp->dataExists('correo',$_POST['correo']);

	echo $res;
 ?>