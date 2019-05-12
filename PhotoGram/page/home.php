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
		height: 0;
		border:0;
	}
	.status-profile{
		width: 40px;
		height: 40px;
		border-radius: 100%;
		border: 1px solid #f0f0f0;
		margin-right: 12px;
	}
</style>
<div class="row">
	<div class="col-md-8">


		<div class="status">
			<!-- buat form upload -->
			<form action="uploadController.php" method="post" enctype="multipart/form-data">
				<h4>Create Status</h4>
				<hr>
				<div class="upload">
					<textarea type="text" class="form-control" name="caption" style="height:38px;"></textarea>
					<button class="upload-image"><i class="fa fa-image"></i></button>
					<input type="file" class="file-upload" name="file">
				</div>
				<br>
				<button type="submit" class="btn btn-primary upload-btn">Upload</button>
			</form>

			<!-- status item -->
			<?php 
			$status = isset($_GET['id']) ? (filter($_GET['id']) != '') ? filter($_GET['id']) : false : false;
			if($status==false){
				$q = $connect->query("SELECT s.s_id,u.profile,u.user,s.file,s.sender_id FROM status s LEFT JOIN users u ON s.sender_id = u.id ORDER BY s.s_id DESC");
			}else{
				$q = $connect->query("SELECT s.s_id,u.profile,u.user,s.file,s.sender_id FROM status s LEFT JOIN users u ON s.sender_id = u.id WHERE s.s_id = '$status' ORDER BY s.s_id DESC");
			}
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
					if($rowss['user_id'] == $result['id']){
						$k = 1;
						$likes = $rowss['likes'];
					}
				}
				$icon = 'far fa-heart';
				$url = 'like.php?id='.$row['s_id'].'&user='.$result['id'];
				if($row['s_id'] == $row['s_id']){
					if($k == 1){
						$icon = 'fa fa-heart';
						$url = 'like.php?id='.$row['s_id'].'&user='.$result['id'].'&dislike='.$likes;
					}
				}

				?>
				<div class="status-item">
					<div class="status-header">
						<a href="?page=user&id=<?=$row['sender_id']?>"><img src="<?=$row['profile']!=''?$row['profile']:'../img/logo.png'?>" class="status-profile" alt="<?=$row['user']?>"><?=$row['user']?></a><small> 12menit lalu</small>
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
						<button class="btn text-success" onclick="toggleComment('iframe<?=$i?>')"><i class="fa fa fa-comment"></i></button>
						<a href="https://www.facebook.com/sharer/sharer.php?u=localhost:8000/page/dashboard.php?page=home&id=<?=$row['s_id']?>" class="btn text-warning"><i class="fa fa-share-alt"></i></a>
						&nbsp;<small><?=$Countlike?> like</small>
					</div>
					<iframe id="iframe<?=$i?>" class="iframe" src="comment.php?id=<?=$row['s_id']?>" frameborder="0" style="height:0"></iframe>

				</div>
				<?php
				$i++;
			}
			?>


		</div>

	</div>
	<div class="col-md-4">
		
	</div>
</div>
<script>
	function toggleComment(el = ''){
		var x = document.getElementById(el)
		if(x.style.height!='320px'){
			x.style.height='320px';
		}else{
			x.style.height='0px';
		}
	}
</script>
<?php
}
?>