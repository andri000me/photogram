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

require 'baseController.php';

if(isset($_GET['id'])&&isset($_GET['acc'])){
	$id = $_GET['id'];
	if($id != ''){
		$q = $connect->query("DELETE FROM status WHERE s_id = '$id'");
		if($q){
			redirect('dashboard.php?page=user');
		}else{
			alert('Gagal di hapus :(');
		}
	}else{
		alert('Error id not found!');
	}
}
?>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<br><br>
<div class="container">
	<div class="jumbotron">
		<h1>Anda yakin ingin menghapus?</h1>
		<a href="?acc=true<?=isset($_GET['id']) ? '&id='.filter($_GET['id']) : ''?>" class="btn btn-primary">Ya saya yakin! <i class="fa fa-check"></i></a>
		<a href="dashboard.php?page=user" class="btn btn-danger">Maaf salah pencet! <i class="fa fa-times"></i></a>
	</div>
</div>