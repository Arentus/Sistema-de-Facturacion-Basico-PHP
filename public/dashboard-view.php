<?$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}db.php");

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
 
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="#"><img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/I/41Y4fyn7HAL.png" width="35" height="35" style="margin-right: 5px" alt="">Factusys</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <span class="nav-link" style="color: white; cursor: default;"><i style="margin: 0 5px;" class="fas fa-user"></i><?php echo $_SESSION['user_data']->nombre; ?></span>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="facturas"><i class="far fa-file-alt"></i>Facturas</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="productos"><i class="fas fa-box"></i>Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="clientes"><i class="far fa-address-card"></i>Clientes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="configuracion"><i class="fas fa-wrench"></i>Configuracion</a>
          </li>

          <li class="nav-item">
            <a class="nav-link btn btn-sm btn-danger " href="logout"><i class="fas fa-sign-out-alt"></i>Salir</a>
          </li>

        </ul>
        
      </div>
    </nav>
	
    <main role="main" class="container">
      <div class="jumbotron">
        <h1>Bienvenido/a <strong><?php echo $_SESSION['user_data']->nombre; ?> !</strong></h1>
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
 
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
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