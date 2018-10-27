<?php 
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/error.php';
require_once 'class/user.php';
?>

<?php if (User::userIsAuth()) {
    header('Location: dashboard');
    $_SESSION['message'] = 'Tsss! Parece que ya haz iniciado sesión ... ¿Quieres <a href="logout" value="salir">Salir</a> ? ';
}  
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
	<link rel="stylesheet" type="text/css" href="public/assets/css/registro.css">
</head>

<body>
    <?php if (isset($_SESSION['message'])): ?>
        <div id="logedalert" style="background-color: black; color: white; padding: 1em; position: relative;"><?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
        </div>
      <?php endif ?>
   <nav class="navbar navbar-expand-md navbar-light mb-4">
      <a class="navbar-brand" href="#"><img class="img-fluid" src="https://images-na.ssl-images-amazon.com/images/I/41Y4fyn7HAL.png" width="35" height="35" style="margin-right: 5px" alt="">Factusys</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="home">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="registro">Registrarse</a>
          </li>
        </ul>
        
      </div>
    </nav>

    <div class="container">
      <div class="row">
        
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
     

      <h1>Iniciar Sesion</h1>
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
    
      </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>	
</body>
</html>