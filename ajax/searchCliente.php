<?php
require_once '../config/connection.php';
require_once '../config/db.php';
	
	$html = '';

	$db = getDB();
	$query = $_POST['squery'];


	$result = $db->query("SELECT * FROM usuario WHERE role = 2 AND (nombre LIKE '".$query."%' OR correo LIKE '".$query."%' OR id = '".$query."' )");

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