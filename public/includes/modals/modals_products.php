
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
			    <option value="0" selected>Elige...</option>

			    <?php 

			    $categoria = new Category();
			    $TCategorias = $categoria->getAllCategories();

			    foreach ($TCategorias as $categoria) {
			    	echo '<option title="'.$categoria['descripcion'].'" value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
			    }

			    ?>
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


<!-- Editar Producto Modal -->








<div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Editar Producto</h5>
        <div class="feedback-ajax"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
      	<form id="editProductForm">
		  
		  <input type="hidden" id="id_producto" name="id_producto" value="0">

		  <div class="form-group">
		    <label for="product_name">Nombre</label>
		    <input type="text" name="product_name" autofocus class="form-control namep" id="namep" aria-describedby="productHelp" value="0">
		  </div>
		  
		  <div class="form-group">
		    <label for="product_description">Descripcion</label>
		    <input type="text" name="product_description" class="form-control" id="descriptionp" aria-describedby="productHelp" placeholder="Un titulo que describa tu producto">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Categoria</label>
		     <select name="category_name" class="custom-select my-1 mr-sm-2 categoryp" id="inlineFormCustomSelectPref">
			    <option value="0" selected>Elige...</option>

			    <?php 

			    $categoria = new Category();
			    $TCategorias = $categoria->getAllCategories();

			    foreach ($TCategorias as $categoria) {
			    	echo '<option title="'.$categoria['descripcion'].'" value="'.$categoria['id_categoria'].'">'.$categoria['nombre'].'</option>';
			    }

			    ?>
			  </select>
		  </div>

		  <div class="form-group">
		    <label for="prize">Precio</label>
		    <input type="number" name="prize" id="preciop" class="form-control" id="prize_name" aria-describedby="productHelp" placeholder="Precio">
		  </div>  

		  <div class="form-group">
		    <label for="stock">Stock</label>
		    <input type="number" name="stock" class="form-control" id="stockp" aria-describedby="productHelp" placeholder="Cantidad de Articulos Disponibles">
		  </div>

        <button type="submit" id="save_edited_product" name="edit_product" class="btn btn-primary">Guardar</button>

		</form>
      </div>

      <div class="modal-footer">
        
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div><!-- Editar Producto Modal's End-->
