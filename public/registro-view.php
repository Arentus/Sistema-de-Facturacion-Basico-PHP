<?php session_start(); ?>
<?php include_once 'config/connection.php'; ?>
<?php include_once 'class/user.php'; ?>
<?php include_once 'class/error.php'; ?>

<?php 
/*
if (User::user_is_loggedin()){
	exit();
}*/
?>

<?php 

	if (isset($_POST['submit'])) {	

		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$password = htmlspecialchars(trim($_POST['password']));
		$address = htmlspecialchars($_POST['address']);
		$role = 1;

		$checklist = array(
			'nombre' => $_POST['name'],
			'correo' => $_POST['email'],
			'contraseña' => $_POST['password'],
			'direccion' => $_POST['address']
		);

		$tp = new Errors();
		$errors = $tp->comp_errores($checklist);

		if (empty($errors)) {	
			
			$user = new User();

			try{
		
				$uid = $user->create_user($name,$email,$password,$role,$address);

				echo '<br>';

				if ($uid) {
					echo 'Usuario'.$name.' creado';
				}else{
					echo 'Usuario no creado';
				}

			}catch(Exception $e){
				echo 'Algo ha fallado en la creacion del usuario : '.$e->getMessage();

			}
		}
	}
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Factusys | Registrarse</title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/registro.css">
</head>

<body>
	
	<div>
		<span> <a href="home">Volver al Inicio</a> </span>	
	</div>

	<div class="container">
		<div class="row">
			<form class="form-signin" method="POST" action="registro">

		      <h1 class="h3 mb-3 font-weight-normal">Registrarse</h1>
				
				<?php if (!empty($errors)): ?>
					<div class="alert alert-danger" role="alert">

					 <ul>
					 	 <?php foreach ($errors as $key => $value) {
						 		echo '<li>'.$value.'</li>';
						 	 } 
					 	 ?>
					 </ul>
					</div>
				<?php endif ?>
				

				<div class="form-group">

				    <label for="exampleInputEmail1">Nombre de Usuario: </label>
				    <input type="text" name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Diganos su nombre">
				</div> 
			    <span id="username-availability"></span>
				<div class="form-group">
				    <label for="exampleInputEmail1">Correo</label>
				    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="john@doe.com">   
				</div>   

				<div class="form-group">
				    <label for="exampleInputEmail1">Contraseña</label>
				    <input type="password" name="password" class="form-control" id="exampleInputEmail2" aria-describedby="emailHelp" placeholder="*********************">   
				</div>   

				  <div class="form-group">
				    <label for="exampleFormControlTextarea1">Direccion</label>
				    <input type="text" name="address" class="form-control" name="" placeholder="St Street 47, Ricaurte Plaza">
				  </div>
				<div class="checkbox mb-3">
				<label>
				  <input type="checkbox" value="remember-me">Acepto los <a href="terminos">Terminos y Condiciones</a> de Servicio.
				</label>
				</div>

		      <input class="btn btn-lg btn-primary btn-block" value="Registrarse" type="submit" name="submit"> 

		    </form>
		</div>
	</div>


    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>	
	
	<script type="text/javascript">

		$('document').ready(function(){

			$("#name").change(function(){
				var username = $(this).val();

				$.ajax({
					url : 'ajax/userExistsHandler.php',
					method : "POST",
					data : {name :username },
					dataType : "text",
					success: function(res){

						$('#username-availability').html(res);
					}
				});
			});
		});


		/*
		function ajaxRequest(){
			 if (window.XMLHttpRequest) {
		        return new XMLHttpRequest();
		    } else if (window.ActiveXObject) {
		        return new ActiveXObject("Microsoft.XMLHTTP");
		    } else {
		        alert("Browser does not support XMLHTTP.");
		        return false;
		    }
		}

		var username = document.getElementById('name');

		username.addEventListener('change',()=>{

			var req = new ajaxRequest();

			req.open('POST','ajax/userExistsHandler.php',true);

			req.send(username.value);
			

			var fj_data = JSON.stringify(data);
			alert('fj_data');

			req.onload = function(){
				
				if(req.status === 200){
					//Success
					document.getElementById('tdx').innerHTML = req.responseText;
				}else{

				}
			}

			req.onerror = function(){
				//There was a connection error

			}

		});*/


	</script>
</body>
</html>