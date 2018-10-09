<?
$ds = DIRECTORY_SEPARATOR;

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
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Clientes | <?php echo APP_NAME; ?></title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<link rel="stylesheet" type="text/css" href="public/assets/css/clientes.css">
</head>
<body>

<span class="addc"><button id="myBtn" class="btn btn-lg btn-default"><i class="fas fa-plus"></i>Añadir</button></span>

<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
      <a class="navbar-brand" href="dashboard"><img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/I/41Y4fyn7HAL.png" width="35" height="35" style="margin-right: 5px" alt="">Factusys</a>
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
	
	<div class="container">

		<div class="row">
			<div class="cb-search col-md-3 col-sm-12">
				<h4><i class="fas fa-search"></i>Buscar clientes</h4>
				<hr>
				<input class="form-control form-control-lg" type="text" placeholder="Buscar...">
				<hr>
				
			</div>
			<div class="col-md-9 col-sm-12">
				<table class="table table-dark">
				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Correo</th>
				      <th scope="col">Direccion</th>
				    </tr>
				  </thead>
				  <tbody>
				    <tr>
				      <th scope="row">1</th>
				      <td>Mark</td>
				      <td>mark@mail.com</td>
				      <td>En el coñoelamadre</td>
				    </tr>
				   
				  </tbody>
				</table>
		
			</div>

		</div>

	</div>

	

<!-- The Modal -->

<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Añadir Cliente</h2>
    </div>
    <div class="modal-body">
    	<form >
    		<h4>Nombre</h4>
    		<input name="name" class="form-control form-control" type="text" placeholder="Buscar...">
			<h4>Correo</h4>
    		<input name="email" class="form-control form-control" type="text" placeholder="Buscar...">
			<h4>Direccion</h4>
    		<input name="dir" class="form-control form-control" type="text" placeholder="Buscar...">
    	</form>
    </div>
    <div class="modal-footer">
      <h3><button class="btn btn-sm btn-default">Añadir</button></h3>
    </div>
  </div>

</div>

<script>
// Get the modal
var modal = document.getElementById('myModal');

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>

</body>
</html>