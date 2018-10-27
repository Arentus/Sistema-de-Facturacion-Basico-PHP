<?php
require_once 'config/db.php';
require_once 'config/connection.php';
require_once 'class/user.php';
require_once 'class/error.php';
require_once 'class/product.php';
require_once 'class/category.php';

if (!User::userIsAuth()) {
    header('Location: inicio');

    $_SESSION['message'] = 'Parece que necesitas iniciar sesión antes de continuar...  ';
    die();
} 

?>
<!DOCTYPE html>
<html lang="es">
<head>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Productos | <?php echo APP_NAME; ?></title>

	<link rel="stylesheet" type="text/css" href="node_modules/bootstrap/dist/css/bootstrap.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

	<style type="text/css">
		.addc{
			position: fixed;
			z-index: 1;
			right: 10px;
			bottom: 10px;
		}
	</style>
</head>
<body>
	
 	<?php require_once 'includes/nav.php' ?>

	<div>
		<h1>Productos</h1>
	</div>
	<hr>
	<div class="container-fluid">
		<div class="row"> 
			<div class="col-md-12">
				<div class="search-products">


				<span class="addc"><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>Añadir</button></span>

				<form method="POST" action="">

					<h4>Buscar Productos</h4>
					<input type="text" id="search_product" name="squery" class="form-control form-control-lg mb-3"  placeholder="Buscar...">

				</form>
				<label>Filtrar por Categoria</label>
				<select class="mb-3" id="filter_category" name="filter_category">
					<option value="">No Filtrar</option>
					
				    <?php 

				    $categoria = new Category();
				    $TCategorias = $categoria->getAllCategories();

				    foreach ($TCategorias as $categoria) {
				    	echo '<option title="'.$categoria['descripcion'].'" value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
				    }

				    ?>
				</select>

				<div>
					<a href="agregarCat" class="btn btn-primary mb-3">Agregar Categoria</a>
				</div>
				</div>


			  <div class="table-products">
				
				<table class="table">

				  <thead>
				    <tr>
				      <th scope="col">ID</th>
				      <th scope="col">Nombre</th>
				      <th scope="col">Descripcion</th>
				      <th scope="col">Categoria</th>
				      <th scope="col">Precio</th>
				      <th scope="col">Stock</th>
				      <th scope="col">Acciones</th>
				    </tr>
				  </thead>

				<tbody class="productosData">
							    
			 	 <?php 
				  	$db = getDB();

					$result = $db->query("SELECT COUNT(*) as productos_totales FROM producto");
					
					if ($nProductos = $result->fetchColumn()) {
							
							$nPaginas = ceil( $nProductos / N_PRODUCTOS_BYPAGE );
							
							$product = new Product();

							$resultProductos = $product->getAllProducts();

							if (!empty($resultProductos)) {
								
									$arrProductos = $resultProductos->fetchAll();

									foreach ($arrProductos as $producto	) {
										echo '<tr>';
								
										echo '<td>'.$producto['id_producto'].'</td>';

										echo '<td>'.$producto['producto_nombre'].'</td>';

										echo '<td>'.$producto['descripcion'].'</td>';

										echo '<td>'.$producto['nombre_categoria'].'</td>';
										
										echo '<td>'.$producto['precio'].'</td>';
										
										echo '<td>'.$producto['stock'].'</td>';
										
										echo '<td><button class="btn btn-success m-1 editar_producto" data-toggle="modal" data-target="#editModalCenter" value="'.$producto['id_producto'].'"><i class="far fa-edit"></i></button>';
										echo '<button class="btn btn-danger" id="eliminar_producto" value="'.$producto['id_producto'].'"><i class="far fa-trash-alt"></button></td>';
										echo '</tr>';

									}

							}

					if ($nPaginas > 1) {

				        echo '<nav aria-label="Page navigation example">';
				        echo '<ul class="pagination">';
				 
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
						echo 'No hay productos registrados.';
					}

				?>

				</tbody>

				</table>
				</div>
			</div>
		</div>
	</div>
	
	<?php include_once 'includes/modals/modals_products.php' ?>

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <script type="text/javascript">
    
    $('.pagination li a').on('click', function(){
        $('.productosData').html('<div class="loader loader--style2" title="1"><svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#007BFFFF" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="1s" repeatCount="indefinite"/></path></svg></div>');
 
        var page = $(this).attr('data');		
        var dataString = 'page='+page;
 
        $.ajax({
            type: "GET",
            url: "ajax/getProductos.php",
            data: dataString,
            success: function(data) {
                $('.productosData').fadeIn(200).html(data);
                $('.pagination li').removeClass('active');
                $('.pagination li a[data="'+page+'"]').parent().addClass('active');


            }
        });
        return false;
    }); 

   $(document).ready(function(){
   	
		$("#addProductForm").on('submit',function(e){
			e.preventDefault();

			$.ajax({
				method : "POST",
				url : 'ajax/addProduct.php',
				data : $(this).serialize(),
				success : function(res){

					alert(res);
				}
			})
		});
	
		
   	$(document).on('click', ".editar_producto", function(){
   		alert('si');
	});
	   	$("#filter_category").on('change',function(e){
	   		var cat = $('option:selected',this).attr('value');
	   		
	   		$.ajax({
	   			method : "GET",
	   			url : 'ajax/getProductsByCategory.php',
	   			data: {filter_category:cat}, //el nombre de la variable es el indice pasado en este objeto 'filter_Category'
	   			success : function(res){
	   			
	   				$(".productosData").html(res);
	   			}
	   		})
	   	});


    $("#search_product").on('keyup',function(e){
        //alert('escrito'+$(this).val());
        $.ajax({
        url : 'ajax/searchProduct.php',
        method : "POST",
        data : {squery :$(this).val()},
        success: function(res){
            $(".productosData").fadeIn().html(res);
        }
    });
    });

   });
   $('#myModal').on('shown.bs.modal', function () {
  	$('#myInput').trigger('focus')
	});

  </script>

</body>
</html>