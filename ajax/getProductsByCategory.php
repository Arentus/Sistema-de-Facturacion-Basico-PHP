<?php
require_once '../config/connection.php';
require_once '../config/db.php';
require_once '../class/product.php';

$db = getDB();
$html = '';

if ($_GET['filter_category'] != '') {
	$result = $db->query("SELECT COUNT(*) as productos_totales FROM producto WHERE id_categoria = ".$_GET['filter_category']);
}else{
	$result = $db->query("SELECT COUNT(*) as productos_totales FROM producto");
}

if ($nProductos = $result->fetchColumn()) {
		
$nPaginas = ceil( $nProductos / N_PRODUCTOS_BYPAGE );

$product = new Product();

$result = $product->getAllProducts(0,N_PRODUCTOS_BYPAGE,$_GET['filter_category']);


	if (!empty($result)) {

	    $arrProductos = $result->fetchAll();

	    foreach ($arrProductos as $producto   ) {
	        $html .= '<tr>';
	        $html .= '<td>'.$producto['id_producto'].'</td>';
	        $html .= '<td>'.$producto['producto_nombre'].'</td>';
	        $html .= '<td>'.$producto['descripcion'].'</td>';
	        $html .= '<td>'.$producto['nombre_categoria'].'</td>';
	        $html .= '<td>'.$producto['precio'].'</td>';
	        $html .= '<td>'.$producto['stock'].'</td>';
	        $html .= '<td><button class="btn btn-success m-1 editar_producto"  data-toggle="modal" data-target="#editModalCenter" value="'.$producto['id_producto'].'"><i class="far fa-edit"></i></button>';
       		$html .= '<button class="btn btn-danger" id="eliminar_producto" value="'.$producto['id_producto'].'"><i class="far fa-trash-alt"></button></td>';
	        $html .= '</tr>';
	    }
	}

	if ($nPaginas > 1) {
		$html .= '<div class="new-pagination">';
        $html .= '<nav>';
        $html .= '<ul class="pagination">';
 
        for ($i=1;$i<=$nPaginas;$i++) {
            $class_active = '';
            if ($i == 1) {
                $class_active = 'active';
            }
            $html .= '<li class="page-item '.$class_active.'"><a class="page-link" href="#" data="'.$i.'">'.$i.'</a></li>';
        }
 
        	$html .= '</ul>';
        	$html .= '</nav>';
        	$html .= '</div>';
		}
	

}else{
	echo 'No hay productos bajo esta categoria';
}
echo $html;

?>