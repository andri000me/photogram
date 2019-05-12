<?php 
session_start();
date_default_timezone_set('Asia/jakarta');

require 'page/baseController.php';
require 'connect.php';

if(isset($_COOKIE["user"])||isset($_SESSION['user'])){
	header('Location:dashboard.php');
}

if(isset($_POST['name'])) {
	$name = filter($_POST['name'],$connect);
	$pass = filter($_POST['pass'],$connect);

	if($name!=''&&$pass!=''){

		$query = $connect->query("SELECT * FROM users WHERE user = '$name' OR email = '$name'");

		$result = $query->fetch_assoc();

		if(password_verify($pass, $result['password'])){
			// echo 'Berhasil Login';
			header('Location:page/dashboard.php');
			$cookie = base64_encode($result['id']);
			$_SESSION['user'] = $cookie;
			setcookie("user", $cookie, time()+30*24*60*60);
		}else{
			alert('Gagal Login');
		}


	}else{
		alert('Data jangan kosong');
	}
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Login</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
	<style>
		form{
			margin: auto;
			margin-top: 120px;
			max-width: 400px;
		}
		h1{
			color: grey;
			text-align: center;
		}
	</style>
<body>
	<div class="container">
		<form action="" method="post">
			<h1>Please Login!</h1>
			<p><input type="text" name="name" placeholder="Email" class="form-control"></p>
			<p><input type="password" name="pass" placeholder="Password" class="form-control"></p>
			<p><button type="submit" class="btn btn-primary">Login</button></p>
			<a href="register.php" class="">Create Account</a>
		</form>
		<!-- <a href="<?=base_url()?>/register.php">Register</a> -->
	</div>
</body>
</html>