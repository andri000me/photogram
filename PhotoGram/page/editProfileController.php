<?php 
session_start();
date_default_timezone_set('Asia/jakarta');
require '../connect.php';
require 'baseController.php';

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

if(isset($_FILES['profile']['name'])){
	
	if(strlen($_FILES['profile']['name'])!=0){
		$img = uploadImage('profile');
		$file = $img['file'];
		if($file == ''){
			alert($img['message']);
			redirect('dashboard.php?page=user');
		}else{

			$id = $result['id'];

			$q = $connect->query("UPDATE users SET profile = '$file' WHERE id = '$id'");
			if($q){
				redirect('dashboard.php?page=user');
			}else{
				alert('Gagal upload status');
				redirect('dashboard.php?page=user');
			}
		}
	}else{
		alert('File gambar harus ada!');
		redirect('dashboard.php?page=user');
	}
}
if(isset($_FILES['bg']['name'])){
	
	if(strlen($_FILES['bg']['name'])!=0){
		$img = uploadImage('bg');
		$file = $img['file'];
		if($file == ''){
			alert($img['message']);
			redirect('dashboard.php?page=user');
		}else{

			$id = $result['id'];

			$q = $connect->query("UPDATE users SET bg = '$file' WHERE id = '$id'");
			if($q){
				redirect('dashboard.php?page=user');
			}else{
				alert('Gagal upload status');
				redirect('dashboard.php?page=user');
			}
		}
	}else{
		alert('File gambar harus ada!');
		redirect('dashboard.php?page=user');
	}
}
?>
