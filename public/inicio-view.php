<?php session_start(); ?>
<?php $ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}connection.php");

require_once("{$base_dir}config{$ds}db.php");
require_once("{$base_dir}class{$ds}user.php");
require_once("{$base_dir}class{$ds}error.php");
?>
<?php if (isset($_POST['submit'])) 
  {  
      try{

        $user = new User();
        $err = new Errors();

        $usernameEmail = $_POST['userdata'];
        $password = $_POST['password'];

        $errores = $err->comp_errores(array('nombre o correo'=>$usernameEmail,'contraseña'=>$password));

        if (empty($errores)) {
          if ($user->log_in($usernameEmail,$password)) {
            header('Location: dashboard');
          }
        }
       
       

      }catch(Exception $e){

      }
  } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo APP_NAME ?> | Iniciar Sesion</title>
	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="public/assets/css/iniciar-sesion.css">
</head>

<body>

   
  
	<form class="form-signin" method="POST" action="inicio">

      <?php if (!empty($errores)): ?>
          <div class="alert alert-danger" role="alert">

           <ul>
             <?php foreach ($errores as $key => $value) {
                echo '<li>'.$value.'</li>';
               } 
             ?>
           </ul>
          </div>
        <?php endif ?>
      <div style="text-align: center;"> <a href="home">Volver al Inicio</a> </div>  

      <img class="mb-4" src="https://images-na.ssl-images-amazon.com/images/I/41Y4fyn7HAL.png" alt="" width="72" height="72">

      <h1 class="h3 mb-3 font-weight-normal">Factusys</h1>

      <label for="inputEmail" class="sr-only">Correo o Nombre de Usuario</label>
      
      <input type="text" name="userdata" id="inputEmail" class="form-control" placeholder="Ingresa tu correo o nombre de usuario"  autofocus>

      <label for="inputPassword" class="sr-only">Contraseña</label>
      
      <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Contraseña">

      <div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me">Recordar mi contraseña
        </label>
      </div>

      <input name="submit" class="btn btn-lg btn-primary btn-block" type="submit" value="Iniciar">
    </form>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>	
</body>
</html>