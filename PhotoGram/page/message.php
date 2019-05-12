<?php
if(isset($access)) {
	?>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<style>
		*{box-sizing: border-box;}
		.wrap-message{
			width: 100%;
			overflow: auto;
		}
		.profile-img{
			width: 40px;
			height: 40px;
			border-radius: 100%;
			border: 1px solid #f0f0f0;
			margin-right: 12px;
		}
		.det{
			display: none;
			text-align: center;
		}
		.chat{
			word-wrap: break-word;
			width: 100%;
			max-width: 300px;
			padding: 12px;
			border-radius: 8px;
			box-shadow: 0px 0px 6px lightgrey;
			margin: 12px 0;
			font-family: 'Roboto', sans-serif;
		}
		.msg-box{
			min-height: 100vh
		}
		.chat .time{
			font-size: 10px;
			color: grey;
		}
		.msg-alert{
			float: left;
			width: 100%;
			font-size: 12px;
		}
		.msg-box:after,.msg-box:before{
			clear: both;
			content: '';
			display: table;
		}
		.chat-friend .time{color:white;}
		.chat-me{float:right;border-top-right-radius: 0;}
		.chat-friend{float:left;background-color: #0d0;color:white;border-top-left-radius: 0;}
		@media(max-width: 768px){
			.det{
				display: block;
			}
			.wrap-message{
				width: 100%;
				overflow-x:scroll;
			}
			.wrap-container{
				width: 200%;
			}
			.chat{
				max-width: 180px;
			}
		}
	</style>
	<div class="wrap-message">
		<div class="container wrap-container">
			<div class="row">
				<div class="col-6 col-md-4">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<h4 class="det">SWIPE<span class="fa fa-chevron-right"></span></h4>
								<h5>Friend list</h5>
							</div>
						</div>
						<div class="card-body">
							<form action="">
								<input type="search" name="search" class="form-control" placeholder="Search Teman">
								<input type="hidden" value="message" name="page">
								<input type="hidden" name="id" value="<?=isset($_GET['id'])?filter($_GET['id']):''?>">
							</form>
							<br>
							<ul class="list-group">
								<?php 
								require 'baseController.php';
								$me = $result['id'];
								$search = isset($_GET['search']) ? filter($_GET['search']) : '';
								$q = $connect->query("SELECT id,friend FROM friend WHERE me = '$me' ORDER BY id DESC LIMIT 8");
								while ($row = $q->fetch_assoc()) {
									$friend = $row['friend'];
									if($search != ''){
										$qf = $connect->query("SELECT * FROM users a INNER JOIN (SELECT * FROM friend WHERE me = '$friend' AND friend = '$me') b ON a.id = b.me WHERE a.user LIKE '%$search%'");
									}else{
										$qf = $connect->query("SELECT * FROM users a INNER JOIN (SELECT * FROM friend WHERE me = '$friend' AND friend = '$me') b ON a.id = b.me");
									}
									while($rows = $qf->fetch_assoc()){
										?>

										<li class="list-group-item">
											<a href="?page=user&id=<?=$row['friend']?>">
											<img class="profile-img" src="<?=$rows['profile']!=''?$rows['profile']:'../img/logo.png'?>" alt="<?=$rows['user']?>">
											</a>
											<a href="?page=message&id=<?=$row['friend']?>"><?=$rows['user']?></a>
										</li>
										<?php
									}
								}
								?>
							</ul>
						</div>
					</div>
				</div>
				<div class="col-6 col-md-8">
					<div class="card">
						<div class="card-header">
							<div class="card-title">
								<h5>Message&nbsp;<b>
									<?php
									if(isset($_GET['id'])){
										$ff = $_GET['id'];
										$qf = $connect->query("SELECT user FROM users")->fetch_assoc();
										echo $qf['user'];
									}
									?></b></h5>
								</div>
							</div>
							<div class="card-body msg-box">
							</div>
							<div class="card-footer">
								<?php 
								if(isset($_POST['message'])){
									$msg = filter($_POST['message']);
									$msg = str_replace(['<','>'], ['&lt;','&gt;'], $msg);
									$id = isset($_GET['id']) ? filter($_GET['id']) : '';
									$met = $result['id'];
									$msgin = $connect->query("INSERT INTO message(msg_send,msg_receive,message) VALUES('$met','$id','$msg')");
									if($msgin){
										$rr = $_SERVER['REQUEST_URI'];
										redirect($rr);
									}else{
										alert('Gagal kirim pesan');
									}
								}
								?>
								<form action="" method="post">
									<div class="container">
										<div class="row">
											<div class="col-10">
												<input type="text" class="form-control" name="message">
											</div>
											<div class="col-2">
												<button class="btn btn-primary"><i class="fa fa-paper-plane hidden-xs"></i></button>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<script>
			load();
			function load(){
				$.ajax({
					url:'localhost:8000/page/msg.php',
					type:'POST',
					data:'id=<?=isset($_GET['id'])?filter($_GET['id']):''?>',
					dataType:'html',
					cache: false,
					success:function(res){
						$('.msg-box').html(res);
					}
				});
			}
			setInterval(load,3000);
		</script>
		<?php
	}
	?>