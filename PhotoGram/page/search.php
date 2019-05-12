<?php
if(isset($access)) {
	?>
	<link rel="stylesheet" href="https://idangero.us/swiper/dist/css/swiper.min.css">
	<script src="https://idangero.us/swiper/dist/js/swiper.min.js"></script>
	<style>
		.linkfriend{color: grey;}
		.recomend .card{width: 100%;background-color: transparent;border:0;}
		.recomend .card, .card-body{
		}
		.recomend .card-body{
			border-radius: 100% !important;
			background-position: center;
			background-size: cover;
			padding-top: 100%;
			padding-left: 100%;
			border: 1px solid #f0f0f0;
		}
		.recomend .user-name{
			font-size: 14px;
			text-align: center;
			color: dodgerblue;
			font-weight: bold;
		}
		.swiper-container {
			width: 100%;
			height: 100%;
		}
		.swiper-slide {
			padding: 18px;
			text-align: center;
			font-size: 18px;
			background: transparent;

			/* Center slide text vertically */
			display: -webkit-box;
			display: -ms-flexbox;
			display: -webkit-flex;
			display: flex;
			-webkit-box-pack: center;
			-ms-flex-pack: center;
			-webkit-justify-content: center;
			justify-content: center;
			-webkit-box-align: center;
			-ms-flex-align: center;
			-webkit-align-items: center;
			align-items: center;
		}
		.user-list{width: 100%}
		.btn-likes{
			font-size: 10px;
			padding: 0;
			width: 100%;
		}
		.logo-users{
			width: 40px;
			height: 40px;
			border-radius: 100%;
			margin-right: 12px;
			border: 1px solid #f0f0f0;
		}
	</style>
	<form action="" method="get">
		<input type="hidden" name="page" value="search">
		<input type="search" class="form-control" name="user" placeholder="Cari teman">
	</form>
	<br>
	<b>Rekomendasi teman</b>
	<div class="recomend row container">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php 
				$id = $result['id'];
				$q = $connect->query("SELECT id,profile,user FROM users WHERE id != '$id' ORDER BY id ASC LIMIT 24");
				$i = 0;
				while($row = $q->fetch_assoc()){
					$btn = 'btn-light';
					$icon = 'fa-plus';

					$friend = $row['id'];
					$qq = $connect->query("SELECT id FROM friend WHERE me = '$id' AND friend = '$friend'");
					if($qq->num_rows == 1){
						$btn='btn-warning text-white';
						$icon = 'fa-minus';
					}
					?>
					<div class="swiper-slide">
						<div class="card">
							<div class="card-body" style="background-image: url('<?=$row['profile'] != ''?$row['profile']:'../img/logo.png'?>');">
							</div>
							<div class="user-name"><?=(strlen($row['user']) > 6) ? substr($row['user'],0,5).'..' : $row['user'] ?>
							<a href="follow.php?id=<?=$row['id']?>" class="btn <?=$btn?> btn-likes"><i class="fa <?=$icon?>"></i></a>
						</div>
					</div>
				</div>
				<?php
				$i++;
			}
			?>
		</div>
	</div>
	<br>
	<ul class="list-group user-list">
		<?php 
		if(isset($_GET['user'])){
			$user = filter($_GET['user']);
			$id = $result['id'];
			$q = $connect->query("SELECT * FROM users  WHERE user LIKE '%$user%' AND id != '$id' ORDER BY id ASC");
			while($results = $q->fetch_assoc()){
				$teks = "Follow";
				$btn = 'btn-light';
				$icon = 'fa-plus';

				$friend = $results['id'];
				$qq = $connect->query("SELECT * FROM friend WHERE me = '$id' AND friend = '$friend'");
				if($qq->num_rows == 1){
					$teks = "Unfollow";
					$btn='btn-primary text-white';
					$icon = 'fa-minus';
				}
				?>
				<li class="list-group-item">
					<a href="?page=user&id=<?=$results['id']?>">
					<div class="left linkfriend"><img src="<?=$results['profile'] != ''?$results['profile']:'../img/logo.png'?>" class="logo-users" alt=""><b><?=$results['user']?></b>
						<br><small>100 teman yang sama</small></div>
						<div class="right"><a href="follow.php?id=<?=$results['id']?>&user=<?=$user?>" class="btn <?=$btn?>"><?=$teks?> <i class="fa <?=$icon?>"></i></a></div>
						<div class="clear"></div>
					</a>
				</li>
				<?php
			}
		}
		?>
	</ul>
	<script>
		var x = 10;
		window.addEventListener('load', swippers);
		window.addEventListener('resize', swippers);
		function swippers(){
			var w = innerWidth;
			if(w < 480){
				x = 4;
			}else if(w < 760){
				x = 6;
			}else if(w < 968){
				x = 8;
			}else if(w < 1366){
				x = 10
			}
			var swiper = new Swiper('.swiper-container', {
				slidesPerView:x,
				spaceBetween: 0,
				pagination: {
					el: '.swiper-pagination',
					clickable: true,
				},
			});
		}
	</script>
	<?php
}
?>