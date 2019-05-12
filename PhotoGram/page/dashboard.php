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
	<title>Dashboard</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
</head>
<style>
	*{
		margin: 0px;
		padding: 0px;
		box-sizing: border-box;
	}
	*:focus{
		outline: none;
	}
	body{
		background-color: #f0f0f0;
	}
	nav{
		position: fixed;
		width: 100%;
		z-index: 1000;
		top:0;

		padding: 0 !important;
		background-color: dodgerblue;
	}
	nav a{
		width: 24%;
		text-align: center;
		display: inline-table;
		padding: 8px;
		color: rgba(0,0,0,0.3);
		font-size: 22px;
	}
	nav a.active{
		color: white;
	}

	/*float*/
	.left{float: left;}
	.right{float: right}
	.clear{clear: both;}
</style>
<body>
	<?php include 'navTemplate.php' ?>
	<div class="container" style="margin-top: 80px">

		<section>
			<?php 
			$access = true;
			if(isset($_GET['page'])){
				$page = filter($_GET['page']);
				switch ($page) {
					case 'search':
						include 'search.php';
						break;

					case 'message':
						include 'message.php';
						break;

					case 'user':
						include 'user.php';
						break;
					
					default:
						include 'home.php';
						break;
				}
			}else{
				include 'home.php';
			}
			 ?>
		</section>
	</div>

</body>
</html>