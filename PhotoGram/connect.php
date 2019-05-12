<?php 
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'belajarauth';

$connect = new mysqli($host, $user, $pass, $db) or die('Error Database'); // koneksiin database



function filter($data, $con='') {
	$data = trim(htmlentities(strip_tags($data)));

	if (get_magic_quotes_gpc()){
		$data = stripslashes($data);
	}

	if($con != ''){
		$data = mysqli_real_escape_string($con,$data);
	}

	return $data;
}
function base_url(){
	return $_SERVER['HTTP_HOST'];
}
 ?>
