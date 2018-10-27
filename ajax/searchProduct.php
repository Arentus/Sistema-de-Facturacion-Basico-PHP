<?php
require_once '../config/connection.php';
require_once '../config/db.php';
require_once '../class/product.php';
	
	$html = '';

	$db = getDB();
	$query = $_POST['squery'];
	$product = new Product();


	$result = $db->query("SELECT producto.id_producto, producto.nombre AS producto_nombre, producto.descripcion, categoria.nombre AS nombre_categoria,  producto.precio,producto.stock FROM producto INNER JOIN categoria ON categoria.id_categoria = producto.id_categoria WHERE producto.nombre LIKE '".$query."%' OR producto.id_producto = '".$query."'");

	if ($result->rowCount() > 0) {

	    $arrProductos = $result->fetchAll();

	    foreach ($arrProductos as $producto) {
	        $html .= '<tr>';
	        $html .= '<td>'.$producto['id_producto'].'</td>';
	        $html .= '<td>'.$producto['producto_nombre'].'</td>';
	        $html .= '<td>'.$producto['descripcion'].'</td>';
	        $html .= '<td>'.$producto['nombre_categoria'].'</td>';
	        $html .= '<td>'.$producto['precio'].'</td>';
	        $html .= '<td>'.$producto['stock'].'</td>';
	        $html .= '</tr>';
	    }

	}else{
		echo 'Conchale, No hay resultados para tu busqueda :/';
	}
	echo $html;

?>