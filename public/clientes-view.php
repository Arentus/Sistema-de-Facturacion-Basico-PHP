<?php
$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}db.php");
require_once("{$base_dir}config{$ds}connection.php");

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
<?php require_once 'includes/nav.php' ?>
<span class="addc"><button id="myBtn" class="btn btn-lg btn-default"><i class="fas fa-plus"></i>Añadir</button></span>

	
	<div class="container">

		<div class="row">
			
			<div class="cb-search col-md-3 col-sm-12">
				<h4><i class="fas fa-search"></i>Buscar clientes</h4>
				
				<hr>
				<form method="POST" action="">
					
					<input type="text" id="search_custom" name="squery" class="form-control form-control-lg"  placeholder="Buscar...">
				</form>

				<br>


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
				<tbody class="clientesData">
				    
			  <?php 
				  	$db = getDB();

					$result = $db->query("SELECT COUNT(*) as clientes_totales FROM usuario WHERE role = 2");

					//hay clientes
					if ($nClientes = $result->fetchColumn()) {
							
							$nPaginas = ceil( $nClientes / N_CLIENTES_BYPAGE );

							$sql = 'SELECT * FROM usuario WHERE role = 2 ORDER BY id ASC LIMIT 0 , '.N_CLIENTES_BYPAGE;

							$resultClientes = $db->query($sql);

							if ($resultClientes->rowCount()>0) {
								
									$arrClientes = $resultClientes->fetchAll();

									foreach ($arrClientes as $cliente	) {
										echo '<tr>';
								
										echo '<td>'.$cliente['id'].'</td>';

										echo '<td>'.$cliente['nombre'].'</td>';

										echo '<td>'.$cliente['correo'].'</td>';

										echo '<td>'.$cliente['direccion'].'</td>';

										echo '</tr>';
									}

							}

							if ($nPaginas > 1) {
				        echo '<nav aria-label="Page navigation example">';
				        echo '<ul class="pagination justify-content-end">';
				 
				        for ($i=1;$i<=$nPaginas;$i++) {
				            $class_active = '';
				            if ($i == 1) {
				                $class_active = 'active';
				            }
				            echo '<li class="page-item '.$class_active.'"><a class="page-link" href="#" data="'.$i.'">'.$i.'</a></li>';
				        }
				 
				        echo '</ul>';
				        echo '</nav>';
							}
					}else{
						echo 'No hay clientes registrados.';
					}

				?>
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
    		<span id="email-availability"></span>
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

  <script type="text/javascript" src="public/assets/js/ajax.js"></script>
<script>

/*===================================
|   ajax scripts
|=======================================*/

//replaced by js/ajax.js
$(document).ready(function() {  

    $("#search_custom").on('keyup',function(e){
        //alert('escrito'+$(this).val());
        $.ajax({
        url : 'ajax/searchCliente.php',
        method : "POST",
        data : {squery :$(this).val()},
        success: function(res){
            $(".clientesData").fadeIn().html(res);
        }
    });
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