<?php
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/user.php';
require_once 'class/error.php';
require_once 'class/product.php';
require_once 'class/category.php';
?>

<?php if (!User::userIsAuth()) {
    header('Location: inicio');

    $_SESSION['message'] = 'Parece que necesitas iniciar sesión antes de continuar...  ';
    die();
} ?>

<?php 
	if (isset($_POST['add_category'])) {

		$checklist = array( 
			'nombre' => $_POST['category_name'],
			'descripcion' => $_POST['category_description']
		);

		$tp = new Errors();
		$errors = $tp->comp_errores($checklist);

		if (empty($errors)) {	

			$category = new Category();

			$name = ucfirst(strtolower(htmlspecialchars(trim($_POST['category_name']))));
			$description = ucfirst(strtolower(htmlspecialchars(trim($_POST['category_description']))));	

			$dtx = $tp->dataExists('nombre',$name,'categoria');
			
			if ($dtx == 'true') {
				
				echo $category->add_category($name,$description);				
			}else{
				$errors[] = 'Esta categoria ya existe.';
			}

		}	
	}
?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Agregar Categoria | <?php echo APP_NAME; ?></title>

	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

</head>
<body>


 	<?php require_once 'includes/nav.php' ?>

	<div class="container">
		<div class="row">
			<div class="col-md-12">

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

				<div class="badge">
					<h1>Añadir Categoria</h1>
				</div>
				<form id="addProductForm" method="POST" action="agregarCat">
				  <div class="form-group">
				    <label for="category_name">Nombre</label>
				    <input type="text" name="category_name" class="form-control" id="category_name_name" aria-describedby="productHelp" placeholder="Un titulo que describa tu categoria">
				  </div>
				  
				  <div class="form-group">
				    <label for="product_description">Descripcion</label>
				    <input type="text" name="category_description" class="form-control" id="product_description" aria-describedby="productHelp" placeholder="Un titulo que describa tu categoria">
				  </div>
				 
		        <button type="submit" id="add_category" name="add_category" class="btn btn-primary">Añadir Categoria</button>

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

</body>
</html>