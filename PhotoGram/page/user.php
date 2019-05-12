<?php
if(isset($access)) {
	?>
	<style>
		/*status*/
		.status{
			width: 100%;
			min-height: 100vh;
			background-color: white;
			border-left: 1px solid lightgrey;
			border-right: 1px solid lightgrey;
			padding: 24px;
		}
		hr{
			margin: 12px -24px;
		}

		/*upload*/
		.upload{
			position: relative;
		}
		.upload-image{
			position: absolute;top:0;right:0;
			padding: 7px 12px;
			background-color: green;
			border: 0;
			color: white;
			border-radius: 4px;
			border-top-left-radius: 0px;
			border-bottom-left-radius: 0px;
		}
		.file-upload{
			position: absolute;top:0;right:0;
			width: 42px;
			opacity: 0;
		}
		.upload-btn{margin-bottom: 48px;}

		/*status-item*/
		.status-item{		
		}
		.status-header{margin-top: 32px}
		.status-header a{font-weight: bold;}
		.status-header small{font-size: 12px;color:grey;padding-left: 12px}
		.status-body{
			/*height: 100px;*/
			font-size: 16px;
			font-weight: bold;
		/*font-size: 12px;
		font-size: 20px;
		font-size: 24px;*/
		color: #666;
	}
	.img-responsive{width: 100%;}
	.img{margin: -12px -24px}
	.iframe{
		width: 100%;
		height: 160px;
		border:0;
	}
	.userstatus .card{
		overflow: hidden;
	}
	.userstatus .card-body{
		position: relative;
		height: 320px;
		/*overflow: hidden;*/
	}
	.userprofile{
		position: absolute;
		top: 40px;
		left: 50%;
		transform: translate(-50%, -50%);
		width: 160px;
		height: 160px;
		border: 8px solid white;
		border-radius: 100%;
	}
	.btn-pr1{
		position: absolute;
		bottom:0px;
		left: 0;
		margin: 12px;
		width: 200px;
	}
	.btn-pr2{
		position: absolute;
		bottom:40px;
		left: 0;
		margin: 12px;
		width: 200px;
	}
	.inf{
		opacity: 0;
	}
	.profiles-detail{
		background-repeat: no-repeat;
		background-size: cover;
		background-position: center;
	}
	.detailss{
		font-size: 13px;
	}
</style>
<?php 
$x = true;
$id;
if(isset($_GET['id'])){
	$id = filter($_GET['id']);
	if($id != ''){
		$mjj = $result['id'];
		if($id!=$mjj){
			$qd = $connect->query("SELECT * FROM users WHERE id = '$id'");
			$rowdata = $qd->fetch_assoc();
			$x = false;
		}else{
			$rowdata = $result;
		}

	}else{
		$rowdata = $result;
	}
}else{
	$rowdata = $result;
}
?>
<div class="row">
	<div class="col-md-12">
		<div class="card userstatus">
			<div class="card-header">
				<div class="card-title">
					<h2>Profile</h2>
				</div>
			</div>
			<div class="card-body profiles-detail" style="background-image: url('<?=$rowdata['bg'] != ''?$rowdata['bg']:'../img/background.jpg'?>')">
				<img src="<?=$rowdata['profile'] != ''?$rowdata['profile']:'../img/logo.png'?>" alt="<?=$rowdata['user']?>" class="userprofile">
				
				<?php
				if($x){
				?>
				<button class="btn-pr1 btn btn-primary">Ubah Photo Profile</button>
				<button class="btn-pr2 btn btn-primary">Ubah Photo background</button>
				<form action="editProfileController.php" method="post" id="formedit1" enctype="multipart/form-data">
					<input type="file" class="btn-pr1 inf btn" name="profile" onchange="document.getElementById('formedit1').submit()">
				</form>
				<form action="editProfileController.php" method="post" id="formedit2" enctype="multipart/form-data">
					<input type="file" class="btn-pr2 inf btn" name="bg" onchange="document.getElementById('formedit2').submit()">
				</form>
				<?php
				}
				?>
			</div>
		</div>
		<br>
	</div>
	<div class="col-md-4">
		<div class="card">
			<div class="card-header">
				<div class="card-title"><b>Profile</b></div>
			</div>
			<div class="card-body">
				<div class="row detailss">
					<?php 
					$mef = $rowdata['id'];
					$fr = $connect->query("SELECT COUNT(*) FROM friend WHERE me = '$mef'");
					$follower = $fr->fetch_assoc()['COUNT(*)'];
					$fr = $connect->query("SELECT COUNT(*) FROM friend WHERE friend = '$mef'");
					$following = $fr->fetch_assoc()['COUNT(*)'];
					?>
					<div class="col-4">
						<b>Follower</b>
					</div>
					<div class="col-8">
						<a href="#" class="btn btn-success"><span class="badge bg-white text-success"><?=$follower?></span> Follower</a>
						<br><br>
					</div>
					<br><br>
					<div class="col-4">
						<b>Following</b>
					</div>
					<div class="col-8">
						<a href="#" class="btn btn-warning"><span class="badge bg-white text-warning"><?=$following?></span> Following</a>
					</div>
					<div class="col-4">
						Name
					</div>
					<div class="col-8">
						<?=$rowdata['user']?>
					</div>
					<div class="col-4">
						Email
					</div>
					<div class="col-8">
						<?=$rowdata['email']?>
					</div>
					<div class="col-4">
						Gender
					</div>
					<div class="col-8">
						<?=$rowdata['gender']!=''?$rowdata['gender']:'-'?>
					</div>
					<div class="col-4">
						Hobby
					</div>
					<div class="col-8">
						<?=$rowdata['hobi']!=''?$rowdata['hobi']:'-'?>
					</div>
					<div class="col-4">
						Bio
					</div>
					<div class="col-8">
						<?=$rowdata['bio']!=''?$rowdata['bio']:'-'?>
					</div>
					<div class="col-4">
						Website
					</div>
					<div class="col-8">
						<?=$rowdata['website']!=''?$rowdata['website']:'-'?>
						<br><br>
					</div>
					<?php 
					if($x){
						?>
						<div class="col-12">
							<a href="edit.php" class="btn btn-success">Edit Profile</a>
							<br><br>
						</div>
						<div class="col-12">
							<a href="../logout.php" class="btn btn-danger">Logout</a>
						</div>
						<?php
					}else{
						$mei = $result['id'];
						$h = $connect->query("SELECT * FROM friend WHERE me = '$mei' AND friend = '$id'");
						$teksr = '';
						$btn = '';
						if($h->num_rows == 0){
							// belum follow
							$teksr = 'Follow';
							$btn = 'btn-light';
						}else{
							$teksr = 'Unfollow';
							$btn = 'btn-info';
						}
						?>
						<div class="col-12">
							<a class="btn <?=$btn?>" href="follow.php?id=<?=$id?>&page=user&user=<?=$id?>"><?=$teksr?></a>
						</div>
						<?php
					}
					?>
				</div>
			</div>
		</div>
		<br>
		<?php 
		if($x){
			?>
			<div class="card">
				<div class="card-header">
					<div class="card-title"><b>Notification</b></div>
				</div>
				<div class="card-body">
					<ul class="list-group">
						<?php 
						$name = $rowdata['user'];
						$qc = $connect->query("SELECT * FROM notification WHERE user_name = '$name' ORDER BY id DESC LIMIT 24");
						while($rowf = $qc->fetch_assoc()){
							?>
							<li class="list-group-item"><a href="<?=$rowf['link']?>"><i class="fa fa-bell"></i> <?=$rowf['caption']?></a></li>
							<?php
						}
						?>
					</ul>
				</div>
			</div>
			<?php
		}
		?>
		<br>
	</div>
	<div class="col-md-8">


		<div class="status">
			<!-- buat form upload -->
			<?php 
			if($x){
				?>
				<form action="uploadController.php" method="post" enctype="multipart/form-data">
					<h4>My Status</h4>
					<hr>
					<div class="upload">
						<input type="text" class="form-control" name="caption"/>
						<button class="upload-image"><i class="fa fa-image"></i></button>
						<input type="file" class="file-upload" name="file">
					</div>
					<br>
					<button type="submit" class="btn btn-primary upload-btn">Upload</button>
				</form>
				<?php
			}
			?>

			<!-- status item -->
			<?php 
			$idme = $rowdata['id'];
			$q = $connect->query("SELECT s.s_id,u.profile,u.user,s.file,s.sender_id FROM status s LEFT JOIN users u ON s.sender_id = u.id WHERE s.sender_id = '$idme' ORDER BY s.s_id DESC");
			$i = 0;
			while($row = $q->fetch_assoc()){

				// karna gua bingung gua pake cara ini yg penting bisa
				//hehehehe
				$sid = $row['s_id'];
				$qq = $connect->query("SELECT user_id,likes FROM likes WHERE status_id = '$sid'");
				$Countlike =$qq->num_rows;
				$k = 0;
				$likes = '';
				while($rowss = $qq->fetch_assoc()){
					if($rowss['user_id'] == $rowdata['id']){
						$k = 1;
						$likes = $rowss['likes'];
					}
				}
				$icon = 'far fa-heart';
				$url = 'like.php?id='.$row['s_id'].'&user='.$rowdata['id'];
				if($row['s_id'] == $row['s_id']){
					if($k == 1){
						$icon = 'fa fa-heart';
						$url = 'like.php?id='.$row['s_id'].'&user='.$rowdata['id'].'&dislike='.$likes;
					}
				}

				?>
				<div class="status-item">
					<div class="status-header">
						<div class="left"><a href="#"><?=$row['user']?></a><small> 12menit lalu</small></div>
						<div class="right">
							<?php 
							if($x){
								?>
								<a class="text-danger" href="deleteStatus.php?id=<?=$row['s_id']?>"><i class="fa fa-trash"></i></a>
								<?php
							}
							 ?>
						</div>
						<div class="clear"></div>
					</div>
					<hr>
					<div class="status-body">
						<div class="img">
							<img src="<?=$row['file']?>" alt="image" class="img-responsive">
						</div>
					</div>
					<hr>
					<div class="status-footer">
						<a href="<?=$url?>" class="btn text-danger"><i class="<?=$icon?>"></i></i></a>
						<button class="btn text-success" onclick="document.getElementById('iframe<?=$i?>').style.height='160px'"><i class="fa fa fa-comment"></i></button>
						<a href="#" class="btn text-warning"><i class="fa fa-share-alt"></i></a>
						&nbsp;<small><?=$Countlike?> like</small>
					</div>
					<iframe id="iframe<?=$i?>" class="iframe" src="comment.php?id=<?=$row['sender_id']?>" frameborder="0" style="height:0"></iframe>

				</div>
				<?php
				$i++;
			}
			?>


		</div>

	</div>
</div>
<?php
}
?>
