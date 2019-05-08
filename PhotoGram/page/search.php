<?php
if(isset($access)) {
	?>
<link rel="stylesheet" href="https://idangero.us/swiper/dist/css/swiper.min.css">
<script src="https://idangero.us/swiper/dist/js/swiper.min.js"></script>
	<style>
		.linkfriend{color: grey;}
		.recomend .card{width: 100%;background-color: transparent;border:0;}
		.recomend .card, .card-body{
			border-radius: 12px !important;
		}
		.recomend .card-body{
			background-position: center;
			background-size: cover;
			padding-top: 100%;
			padding-left: 100%;
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
	</style>
	<input type="search" class="form-control" placeholder="Cari teman">
	<br>
	<b>Rekomendasi teman</b>
	<div class="recomend row container">
		<div class="swiper-container">
			<div class="swiper-wrapper">
				<?php 
				$id = $result['id'];
				$q = $connect->query("SELECT * FROM users WHERE id != '$id' ORDER BY id ASC");
				$i = 0;
				while($row = $q->fetch_assoc()){
					?>
					<div class="swiper-slide">
						<div class="card">
							<div class="card-body" style="background-image: url('https://i.pinimg.com/236x/fe/6a/e6/fe6ae64b2246a4cb0c8fc8531964b25f.jpg')">
							</div>
							<div class="user-name"><?=$row['user']?></div>
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
			<!-- <li class="list-group-item"><a href="">
				<div class="left linkfriend"><b>Yudono</b>
					<br><small>100 teman yang sama</small></div>
					<div class="right"><a href="#" class="btn btn-light">Berteman <i class="fa fa-plus"></i></a></div>
					<div class="clear"></div>
				</a>
			</li> -->
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