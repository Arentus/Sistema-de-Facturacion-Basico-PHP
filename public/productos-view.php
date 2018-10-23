<?php
$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}db.php");
require_once("{$base_dir}config{$ds}connection.php");
require_once("{$base_dir}class{$ds}user.php");
require_once("{$base_dir}class{$ds}product.php");
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
	<div class="container">
		<div class="row"> 
			<div class="col-md-12">
				<div class="search-products">


				<span class="addc"><button  type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-plus"></i>Añadir</button></span>

				<form method="POST" action="">

					<h4>Buscar Productos</h4>
					<input type="text" id="search_custom" name="squery" class="form-control form-control-lg"  placeholder="Buscar...">

				</form>
				<label>Filtrar por Categoria</label>
				<select name="filter_category">
					<option>No Filtrar</option>
					<?php  ?>
				</select>

				<div>
					<a href="agregarCat" class="btn btn-primary">Agregar Categoria</a>
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
				    </tr>
				  </thead>
				<tbody class="productosData">
					    
			  <?php 
				  	$db = getDB();

					$result = $db->query("SELECT COUNT(*) as productos_totales FROM producto");
					// -- falta hacer filtracion por categoria 
					//hay productos
					if ($nProductos = $result->fetchColumn()) {
							
							$nPaginas = ceil( $nProductos / N_PRODUCTOS_BYPAGE );
							/*
							---- para filtrar por ID especifico

							SELECT producto.nombre AS producto_nombre,categoria.nombre AS nombre_categoria, FROM producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE producto.id_categoria = 18 ORDER BY producto.id_categoria ASC

							*/
							
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
						echo 'No hay productos registrados.';
					}

				?>
				</tbody>
				</table>
				</div>
			</div>
		</div>

	</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Añadir Producto</h5>
        
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form id="addProductForm">

		  <div class="form-group">
		    <label for="product_name">Nombre</label>
		    <input type="text" name="product_name" class="form-control" id="product_name" aria-describedby="productHelp" placeholder="Un titulo que describa tu producto">
		  </div>
		  
		  <div class="form-group">
		    <label for="product_description">Descripcion</label>
		    <input type="text" name="product_description" class="form-control" id="product_description" aria-describedby="productHelp" placeholder="Un titulo que describa tu producto">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Categoria</label>
		     <select name="category_name" class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref">
			    <option selected>Elige...</option>
			    <option value="1">Comida y Verduras</option>
			    <option value="RO">Ropa</option>
			    <option value="CA">Calzado</option>
			  </select>
		  </div>

		  <div class="form-group">
		    <label for="prize">Precio</label>
		    <input type="number" name="prize" class="form-control" id="prize_name" aria-describedby="productHelp" placeholder="Precio">
		  </div>  

		  <div class="form-group">
		    <label for="stock">Stock</label>
		    <input type="number" name="stock" class="form-control" id="prize_name" aria-describedby="productHelp" placeholder="Cantidad de Articulos Disponibles">
		  </div>

        <button type="submit" id="add_product" name="add_product" class="btn btn-primary">Añadir Producto</button>

		</form>
      </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

      </div>
    </div>
  </div>
</div><!-- Modal's End-->

    <script
  src="https://code.jquery.com/jquery-3.3.1.min.js"
  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
  crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script type="text/javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>

  <script type="text/javascript">
    
    $('.pagination li a').on('click', function(){
        $('.productosData').html('<div class="loader loader--style2" title="1"><svg version="1.1" id="loader-1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"width="40px" height="40px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path fill="#007BFFFF" d="M25.251,6.461c-10.318,0-18.683,8.365-18.683,18.683h4.068c0-8.071,6.543-14.615,14.615-14.615V6.461z"> <animateTransform attributeType="xml" attributeName="transform" type="rotate" from="0 25 25" to="360 25 25" dur="0.6s" repeatCount="indefinite"/></path></svg></div>');
 
        var page = $(this).attr('data');		
        var dataString = 'page='+page;
 
        $.ajax({
            type: "GET",
            url: "ajax/getProductos.php",
            data: dataString,
            success: function(data) {
                $('.productosData').fadeIn(2000).html(data);
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

   });
   $('#myModal').on('shown.bs.modal', function () {
  	$('#myInput').trigger('focus')
	});
  </script>

</body>
</html>