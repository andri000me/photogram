<?php 
session_start();
date_default_timezone_set('Asia/jakarta');
require '../connect.php';

if(isset($_COOKIE["user"])||isset($_SESSION['user']))
{
	$user = isset($_SESSION['user']) ? $_SESSION['user'] : false;

	$user = isset($_COOKIE["user"]) ? $_COOKIE["user"] : false;
	$user=base64_decode($user);

	$query = $connect->query("SELECT * FROM users WHERE id = '$user'");

	$result = $query->fetch_assoc();

}else{
	header('Location:../index.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Edit</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<style>
	.panel-edit{
		max-width: 600px;
		margin: auto;
		margin-top: 32px;
	}
</style>
<body>

	<?php 	
	require 'baseController.php';
	$id = $result['id'];

	if(isset($_POST['name'])){
		$name = filter($_POST['name']);
		$email = filter($_POST['email']);
		$gender = filter($_POST['gender']);
		$hobi = filter($_POST['hobi']);
		$bio = filter($_POST['bio']);
		$web = filter($_POST['web']);
		$q = $connect->query("UPDATE users SET user='$name', email='$email',gender='$gender',hobi='$hobi',bio='$bio',website='$web' WHERE id = '$id'");
		if($q){
			redirect('edit.php');
		}else{
			alert('Gagal ubah data!');
			redirect('edit.php');
		}
	}
	if(isset($_POST['oldpass'])){
		$old = filter($_POST['oldpass']);
		$pass = filter($_POST['pass']);
		$repass = filter($_POST['repass']);
		if($repass==$pass){
			$qp = $connect->query("SELECT * FROM users WHERE id='$id'");
			$rowp = $qp->fetch_assoc();
			$oldf = $rowp['password'];
			$pass = password_hash($pass, PASSWORD_DEFAULT);
			if(password_verify($old, $oldf)){
				$qs = $connect->query("UPDATE users SET password='$pass' WHERE id = '$id'");
				if($qs){
					redirect('edit.php');
				}else{
					alert('Gagal ganti password!');
					redirect('edit.php');
				}
			}else{
				alert('Password salah dengan password lama!');
				redirect('edit.php');
			}
		}else{
			alert('Repassword tidak sama!');
			redirect('edit.php');
		}
	}
	?>

	<div class="card panel-edit">
		<div class="card-header">
			<div class="card-title">
				<a href="dashboard.php?page=user"><i class="fa fa-chevron-left"></i>Back</a><b>&nbsp;&nbsp;Edit Profile</b>
			</div>
		</div>
		<div class="card-body">
			<form action="" method="post">
				<p><input type="text" name="name" placeholder="Name" class="form-control" value="<?=$result['user']?>"></p>
				<p><input type="email" name="email" placeholder="Email" class="form-control" value="<?=$result['email']?>"></p>
				<?php
				$g = $result['gender'];
				$y = '';
				switch ($g) {
					case 'male':
						$y = '<option>male</option><option>female</option>';
						break;

					case 'female':
						$y = '<option>female</option><option>male</option>';
						break;
					
					default:
						$y = '<option value="" class="form-control">--Gender--</option>
					<option>male</option>
					<option>female</option>';
						break;
				}
				?>
				<p><select name="gender" class="form-control">
					<?=$y?>
				</select></p>
				<p><input type="text" placeholder="Hobby" class="form-control" value="<?=$result['hobi']?>" name="hobi"></p>
				<p><input type="text" placeholder="Bio" class="form-control" value="<?=$result['bio']?>" name="bio"></p>
				<p><input type="text" placeholder="Website" class="form-control" value="<?=$result['website']?>" name="web"></p>
				<p><button type="submit" class="btn btn-primary">Change Profile</button></p> 		
			</form>
			<br>
			<form action="" method="post">
				<h4>Change Password</h4>
				<p><input type="password" name="oldpass" class="form-control" placeholder="Old Password"></p>
				<p><input type="password" name="pass" class="form-control" placeholder="New Password"></p>
				<p><input type="password" name="repass" class="form-control" placeholder="Repassword"></p>
				<p><button type="submit" class="btn btn-primary">Change Password</button></p>
			</form>
		</div>
	</div>

</body>
</html>