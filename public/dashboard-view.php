<?php 
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/error.php';
?>

<?php require_once 'class/user.php'; ?>


<?php if (!User::userIsAuth()) {
    header('Location: inicio');

    $_SESSION['message'] = 'Parece que necesitas iniciar sesión antes de continuar...  ';
    die();
} ?>

<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo APP_NAME; ?> | Inicio</title>

	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
  
    <?php require_once 'includes/nav.php' ?>
	
    <main role="main" class="container">
      <div class="jumbotron">
        <h1>Bienvenido/a <strong><?php echo $_SESSION['user_data']->name; ?> !</strong></h1>
        <p class="lead">Este es el dashboard desde el cual puedes hacer muchas cosas interesantes.</p>
        <a class="btn btn-lg btn-primary" href="facturas" role="button">Facturas &raquo;</a>
        <a class="btn btn-lg btn-primary" href="productos" role="button">Productos &raquo;</a>
        <a class="btn btn-lg btn-primary" href="clientes" role="button">Clientes &raquo;</a>

      </div>
      <?php if (isset($_SESSION['message'])): ?>
        <div id="logedalert" style="background-color: black; color: white; padding: 1em; position: relative;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
      <?php endif ?>
    </main>
 
	<script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <script type="text/javascript">
    
    $(document).ready(function(){
      $("#logedalert").slideUp();
    });
  </script>
</body>
</html>
</html>