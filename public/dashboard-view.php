<?php session_start(); ?>
<?php if (!isset($_SESSION['user_id'])) {
	die();
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dashboard | <?php echo $_SESSION['user_data']->nombre; ?> </title>
</head>
<body>
	
	<h1>Bienvenido!</h1>
</body>
</html>