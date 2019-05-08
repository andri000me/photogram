<?php
$home = '';
$search = '';
$message = '';
$user = '';











if(isset($_GET['page'])){
	$page = $_GET['page'];
	switch ($page) {
		case 'search':
			$search = 'active';
			break;

		case 'message':
			$message = 'active';
			break;

		case 'user':
			$user = 'active';
			break;
		
		default: 
			$home = 'active';
			break;
	}
}else{
	$home = 'active';
}
?>
<nav>
		<div align="center">
			<a href="?page=home" class="<?=$home?>"><i class="fa fa-home"></i></a>
			<a href="?page=search" class="<?=$search?>"><i class="fa fa-search"></i></a>
			<a href="?page=message" class="<?=$message?>"><i class="fa fa-envelope"></i></a>
			<a href="?page=user" class="<?=$user?>"><i class="fa fa-user"></i></a>
		</div>
	</nav>