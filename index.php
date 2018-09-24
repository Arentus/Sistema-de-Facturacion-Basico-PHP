<?php 
	if (isset($_GET['view'])) {
		include 'public/'.$_GET['view'].'-view.php';
	}else{
		include 'public/home-view.php';
	}
?>