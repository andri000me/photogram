<?php 
require 'baseController.php';
require '../connect.php';
if(isset($_GET['id'])&&isset($_GET['user'])){
	$id = filter($_GET['id']);
	$user = filter($_GET['user']);

	if(isset($_GET['dislike'])){
		$id = filter($_GET['dislike']);
		$connect->query("DELETE FROM likes WHERE likes = '$id'");
		redirect('dashboard.php');
	}else{
		$q = $connect->query("SELECT likes FROM likes WHERE user_id = '$user' & status_id = '$id'");
		if($q->num_rows == 0){
			$connect->query("INSERT INTO likes(status_id,user_id) VALUES('$id','$user')");
			redirect('dashboard.php');
		}else{
			redirect('dashboard.php');
		}
	}
}
?>