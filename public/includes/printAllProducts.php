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
										echo '<button class="btn btn-danger eliminar_producto" id="" value="'.$producto['id_producto'].'"><i class="far fa-trash-alt"></button></td>';
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
