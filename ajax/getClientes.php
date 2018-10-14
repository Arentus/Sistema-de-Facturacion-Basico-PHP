<?php
require_once '../config/connection.php';
require_once '../config/db.php';

$html = '';

$db = getDB();
$page = $_GET['page'];

$rowsPerPage = N_CLIENTES_BYPAGE;
$offset = ($page - 1) * $rowsPerPage;

sleep(1);
 
$result = $db->query('SELECT * FROM usuario WHERE role = 2 ORDER BY id ASC LIMIT '.$offset. ', '.$rowsPerPage);

if ($result->rowCount() > 0) {

    $arrClientes = $result->fetchAll();

    foreach ($arrClientes as $cliente   ) {
        $html .= '<tr>';
        $html .= '<td>'.$cliente['id'].'</td>';
        $html .= '<td>'.$cliente['nombre'].'</td>';
        $html .= '<td>'.$cliente['correo'].'</td>';
        $html .= '<td>'.$cliente['direccion'].'</td>';
        $html .= '</tr>';
    }

}
 
echo $html;
?>