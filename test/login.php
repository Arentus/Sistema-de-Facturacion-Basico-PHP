<?php session_start(); ?>
<?php 
$ds = DIRECTORY_SEPARATOR;

$base_dir = realpath(dirname(__FILE__)  . $ds . '..') . $ds;

require_once("{$base_dir}config{$ds}connection.php");
require_once("{$base_dir}config{$ds}db.php");
require_once("{$base_dir}class{$ds}user.php");

?>

<?php
 	if(isset($_GET)) {
 		
 		$data = $_GET['data'];
 		$password = $_GET['password'];

 		$user = new User();

 		echo $data." : ".$password;
 		$a = $user->log_in($data,$password);
 	
 		echo $_SESSION['user_id'];
 		
 	}

?>