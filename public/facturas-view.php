<?php
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/user.php';
?>

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
	<title>Facturas | <?php echo APP_NAME; ?></title>

	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
    <?php require_once 'includes/nav.php' ?>
      
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <form>
              <h1>Buscar Factura</h1>
              <hr>
              <input type="text" name="">
              <input type="submit" class="btn btn-default" name="">
            </form>
          </div>

          <div class="col-md-6">
            
            <div class="jumbotron">
              <h1>Agregar Factura Nueva</h1>
              <a href="agregarFactura" class="btn btn-primary ">Nueva Factura</a>
            </div>
          </div>
        </div>
      </div>

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