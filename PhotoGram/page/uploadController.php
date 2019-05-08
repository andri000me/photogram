<?php 
session_start();
date_default_timezone_set('Asia/jakarta');
require 'baseController.php';
require '../connect.php';

$result = '';

if(isset($_COOKIE["user"])||isset($_SESSION['user']))
{
	$user = $_SESSION['user'] | $_COOKIE["user"];
	$user=base64_decode($user);

	$query = $connect->query("SELECT * FROM users WHERE id = '$user'");

	$result = $query->fetch_assoc();

}else{
	header('Location:../index.php');
}


if(strlen($_FILES['file']['name'])!=0){
	$img = uploadImage('file');
	$caption = filter($_POST['caption'],$connect);
	$file = $img['file'];
	if($file == ''){
		alert($img['message']);
		redirect('dashboard.php');
	}else{

		$id = $result['id'];

		$q = $connect->query("INSERT INTO status(sender_id,caption,file) VALUES('$id','$caption','$file')");
		if($q){
			redirect('dashboard.php');
		}else{
			alert('Gagal upload status');
			redirect('dashboard.php');
		}
	}
}else{
	alert('File gambar harus ada!');
	redirect('dashboard.php');
}
 ?>
