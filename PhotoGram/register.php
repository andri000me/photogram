<?php 
date_default_timezone_set('Asia/jakarta');
require 'page/baseController.php';
require 'connect.php';

if(isset($_POST['user'])){

	$name = filter($_POST['user'],$connect);
	$email = filter($_POST['email'],$connect);
	$pass = filter($_POST['pass'],$connect);
	$repass = filter($_POST['repass'],$connect);

	if($name != ''&&$email != ''&&$pass != ''&&$repass != '')
	{
		if($pass == $repass){

			$check = $connect->query("SELECT user FROM users WHERE email = '$email'");

			if($check->num_rows == 0){

				$pass = password_hash($pass, PASSWORD_DEFAULT);

				$sql = "INSERT INTO users(user, email, password,profile,bg,role) VALUES('$name','$email','$pass','','','admin')";
				$query = $connect->query($sql);

				if($query){
					alert('Berhasil daftar');
					redirect('index.php');
				}else{
					alert('Gagal daftar');
				}

			}else{
				alert('Data sudah ada dengan email yang sama!');
			}

		}else{
			alert('Error Password tidak sama');
		}
	}else{
		alert('Error data belum lengkap');
	}
}
?>

<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Register</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<style>
	form{
		margin: auto;
		margin-top: 120px;
		max-width: 400px;
	}
	h2{
		color: grey;
		text-align: center;
	}
</style>
<body>
	<form action="" method="post">
		<h2>Create Account</h2>
		<p><input type="text" name="user" placeholder="Username" class="form-control"></p>
		<p><input type="email" name="email" placeholder="Email" class="form-control"></p>
		<p><input type="password" name="pass" placeholder="Password" class="form-control"></p>
		<p><input type="password" name="repass" placeholder="Repassword" class="form-control"></p>
		<p><button class="btn btn-success">Register</button></p>
		<a href="index.php">Login</a>
		<!-- <a href="<?=base_url()?>/index.php">Login</a> -->
	</form>
</body></html>