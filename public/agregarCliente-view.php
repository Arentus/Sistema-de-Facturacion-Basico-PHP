<?php
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/user.php';
require_once 'class/error.php';
require_once 'class/product.php';
require_once 'class/category.php';
require_once 'class/customer.php';
require_once 'includes/includes.php';

if (!User::userIsAuth()) { User::redir_signin();} 

if (isset($_POST['submit'])) {
	$error = new Errors();

	unset($_POST['submit']);//para ignorar el valor del submit

	$checklist = array(
		'dni' => $_POST['dni'],
		'email' => $_POST['email']
	);

	if (!$errors = $error->arrDataExists($checklist,'customer')) {
		if (!$errors = $error->check_errors($_POST)) {
			$custom = new Customer();
			if ($custom->createCustomer($_POST)) {
				header('Location: clientes');
			}
		}
	}

}

$include = new Includes();
$include->get_header('Agregar Cliente');

?>
<body>


 	<?php require_once 'includes/nav.php' ?>

	<div class="container">
		<div class="row">
			<div class="col-md-8">

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
					<h5>Agregar Cliente</h5>
				</div>
				<form id="addProductForm" method="POST" action="agregarCliente">
						
				<div class="input-group">
				    
				    <input type="text" id="dni" placeholder="DNI" min="0" class="form-control" name="dni">

				    <div class="input-group-prepend" >
				      <div class="input-group-text" style="border: none; background-color: white;">
				      	<select class="form-control" id="select_dni_type" name="dni_type" style="">
				      		<option value="V">V</option>
				      		<option value="E">E</option>
				      	</select>
				      </div>
				    </div>	
				</div>

					<div class="form-group row">
						<div class="col-md-6">
							<label for="category_name">Primer Nombre</label>
							<input type="text" name="first_name" class="form-control" id="first_name" aria-describedby="productHelp" placeholder="Primer Nombre">
						</div>
					 
						<div class="col-md-6">
						  	<label for="category_name">Segundo Nombre</label>
						  	<input type="text" name="sur_name" class="form-control" id="sur_name" aria-describedby="productHelp" placeholder="Segundo Nombre">
						</div>
				  	</div>

				  	<div class="form-group">
						<label for="product_description">Correo</label>
						<input type="text" name="email" class="form-control" id="product_description" aria-describedby="productHelp" placeholder="johndoe@email.com">
					</div>
				  
					<div class="row">
						<div class="col-md-4 form-group">
							<label for="product_description">Donde Vives?</label>
						<select class="form-control" name="country">
							<option value="" >Seleccione...</option>
							<option value="venezuela">Arabia</option>
							<option value="iran">Iran</option>
							<option value="mexico">Mexico</option>
							<option value="venezuela">Venezuela</option>
							<option value="argelia">Argelia</option>
							<option value="españa">España</option>
							<option value="peru">Peru</option>
							<option value="argentina">Argentina</option>
							<option value="aruba">Aruba</option>
							<option value="ecuador">Ecuador</option>
						</select>
						</div>
						<div class="col-md-4">
							<label>Sexo</label>
							<select name="sex" class="form-control">
								<option value="M">Hombre</option>
								<option value="F">Mujer</option>
							</select>
						</div>
						<div class="col-md-4">
							<label>Fecha de Nacimiento</label>
							<input type="date" name="birthdate" class="form-control">

							<input type="hidden" name="state" value="1">

						</div>
					</div>
				<label for="address">Direccion</label>
				<div class="form-group">
					<textarea name="address" class="form-control" placeholder="Describa su direccion">	
					</textarea>
				</div>

		        <button type="submit" id="add_category" name="submit" class="btn btn-primary">Añadir Cliente</button>

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