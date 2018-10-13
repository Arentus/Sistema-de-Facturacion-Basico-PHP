<?php
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
		<div class="errors-feedback" style="background-color: red; color: white;"><ul id="errors-feedback"></ul></div>
    	<form id="addClientForm" method="POST" action="">
    		<h4>Nombre</h4>
    		<input id="name" name="name" class="form-control form-control" type="text" placeholder="Buscar..." required minlength="3">
    		<span id="username-availability"></span>
			<h4>Correo</h4>
    		<input id="email" name="email" class="form-control form-control" type="text" placeholder="Buscar..." required minlength="5">
			<h4>Direccion</h4>
    		<input id="address" name="address" class="form-control form-control" type="text" placeholder="Buscar..." required minlength="20">
    		<h3>
    		<input id="addCustom" type="submit" class="btn btn-success" value="Añadir">
    		</h3>
    	</form>

    </div>
  </div>

</div>
  <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
  <script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>  
<script>

/*===================================
|   ajax scripts
|=======================================*/

$("#addClientForm").on('submit',function(e){

  e.preventDefault();

  $.ajax({
    type : "POST",
    data : $(this).serialize(),
    dataType : "json",
    url : "ajax/createUserHandler.php",
    success : function(res){

    	if(res == true){
    		alert('Usuario agregado');
    	}else{
    		var feedback = '';
    		res.forEach(function(err){
    			feedback += '<li>'+err+'</li>';
    		});

    		$('#errors-feedback').html(feedback);
    	}
    }
  });

});

$("#name").change(function(){
	var username = $(this).val();
	
	if(username == ''){
		$('#username-availability').html('');
	}

	$.ajax({
		url : 'ajax/userExistsHandler.php',
		method : "POST",
		data : {name :username },
		dataType : "json",
		success: function(res){
				console.log(res);
				res ? $('#username-availability').html('Disponible') : $('#username-availability').html('No disponible');
		}
	});
});


/*===================================
|   modal scripts
|=======================================*/

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