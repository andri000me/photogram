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
		// boleh di aktifin
		// $data = mysql_real_escape_string($data);
	}

	return $data;
}
function base_url(){
	return $_SERVER['HTTP_HOST'];
}
 ?>
