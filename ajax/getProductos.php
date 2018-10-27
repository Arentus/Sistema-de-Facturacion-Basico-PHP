<?php
require_once '../config/connection.php';
require_once '../config/db.php';
require_once '../class/product.php';

$html = '';

$db = getDB();
$page = $_GET['page'];

$rowsPerPage = N_PRODUCTOS_BYPAGE;
$offset = ($page - 1) * $rowsPerPage;

sleep(1);
$product = new Product();

$result = $product->getAllProducts($offset,$rowsPerPage);

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
        $html .= '<td><button class="btn btn-success m-1 editar_producto" data-toggle="modal" data-target="#editModalCenter" value="'.$producto['id_producto'].'"><i class="far fa-edit"></i></button>';
        $html .= '<button class="btn btn-danger" id="eliminar_producto" value="'.$producto['id_producto'].'"><i class="far fa-trash-alt"></button></td>';
        $html .= '</tr>';
    }

}
 
echo $html;
?>