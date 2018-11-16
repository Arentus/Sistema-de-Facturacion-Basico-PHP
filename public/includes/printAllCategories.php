<?php   $categoria = new Category();
				    $TCategorias = $categoria->getAllCategories();

				    foreach ($TCategorias as $categoria) {
				    	echo '<option title="'.$categoria['descripcion'].'" value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
				    }
?>