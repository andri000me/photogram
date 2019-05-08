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
</style>
<div class="row">
	<div class="col-md-8">


		<div class="status">
			<!-- buat form upload -->
			<form action="uploadController.php" method="post" enctype="multipart/form-data">
				<h4>Create Status</h4>
				<hr>
				<div class="upload">
					<input type="text" class="form-control" name="caption"/>
					<button class="upload-image"><i class="fa fa-image"></i></button>
					<input type="file" class="file-upload" name="file">
				</div>
				<br>
				<button type="submit" class="btn btn-primary upload-btn">Upload</button>
			</form>

			<!-- status item -->
			<?php 
			$q = $connect->query("SELECT * FROM status s LEFT JOIN users u ON s.sender_id = u.id ORDER BY id ASC");
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
						<a href="#"><?=$row['user']?></a><small> 12menit lalu</small>
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
	<div class="col-md-4">
		b
	</div>
</div>
<?php
}
?>