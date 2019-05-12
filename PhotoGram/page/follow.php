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

$ffr = '';
if(isset($_GET['id'])){
	$id = filter($_GET['id']);
	$me = $result['id'];
	$q = $connect->query("SELECT friend FROM friend WHERE me = '$me' AND friend = '$id'");

	if($q->num_rows > 0){		
		// kalo ada
		$t = $connect->query("SELECT user FROM users WHERE id = '$id'");
		$res = $t->fetch_assoc();
		$ffr = $res['user'];
		$teks = $result['user']." is <b>Unfollow</b> you!";	
		$link = "dashboard.php?page=user&id=".$result['id'];
		$connect->query("INSERT INTO notification(user_name,caption,link) VALUES('$ffr','$teks','$link')");

		$connect->query("DELETE FROM friend WHERE me = '$me' AND friend = '$id'");
		$page = isset($_GET['page']) ? filter($_GET['page']) : '';
		if($page==''){
			$user = isset($_GET['user']) ? '&id='.filter($_GET['user']) : '';
			header('Location:dashboard.php?page=search'.$user);
		}else{
			$user = isset($_GET['user']) ? '&id='.filter($_GET['user']) : '';
			header('Location:dashboard.php?page='.$page.$user);
		}
	}else{
		// kalo gak ada
		$t = $connect->query("SELECT user FROM users WHERE id = '$id'");
		$res = $t->fetch_assoc();
		$ffr = $res['user'];
		$teks = $result['user']." now <b>Following</b> you!";	
		$link = "dashboard.php?page=user&id=".$result['id'];
		$connect->query("INSERT INTO notification(user_name,caption,link) VALUES('$ffr','$teks','$link')");

		$connect->query("INSERT INTO friend(me,friend) VALUES('$me','$id')");
		$user = isset($_GET['user']) ? '&user='.filter($_GET['user']) : '';
		$page = isset($_GET['page']) ? filter($_GET['page']) : '';
		if($page==''){
			$user = isset($_GET['user']) ? '&id='.filter($_GET['user']) : '';
			header('Location:dashboard.php?page=search'.$user);
		}else{
			$user = isset($_GET['user']) ? '&id='.filter($_GET['user']) : '';
			header('Location:dashboard.php?page='.$page.$user);
		}
	}
}
 ?>