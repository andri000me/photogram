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
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
<style>
	.comment{
		font-family: 'arial',sans-serif;
		font-size: 14px;
	}
	.comment p{
		white-space: pre-wrap;
		padding:0;
		margin:0;
		color: #565656;
		line-height: 24px;
		word-wrap: break-word;
	}
	.comment a{
		/*color: blue;*/
		color:#454545;
		display: inline-table;
		padding-right: 12px;
		text-decoration: none;
		font-weight: bold;
	}
	.input-comment{
		margin-top: 12px;
		padding: 6px;
		border-radius: 100px;
		border: 1px solid lightgrey;
	}
	.me{color:#454545 !important;}
	.comment-box small{
		font-size: 10px;
		font-weight: normal;
		color: grey;
	}
</style>
<?php
if (isset($_GET['id'])) {
	$id = filter($_GET['id']);
	if(isset($_POST['comment'])){
		$comment = filter($_POST['comment']);
		$comment = str_replace(['<','>'], ['&lt','&gt'], $comment);
		$x = explode(' ', $comment);
		$user_id = $result['id'];
		$user_name = $result['user'];
		$teks = '<b>'.$user_name.'&nbsp;Tagged You!</b>&nbsp;';
		$tag = [];
		foreach ($x as $key => $value) {
			if(strpos($value,'@') > -1){
				array_push($tag, substr($value, 1));
			}else{
				$teks .= ' '.$value;
			}
		}
		foreach ($tag as $key => $value) {
			$url = 'dashboard.php?page=status&id='.$id;
			$qu = "INSERT INTO notification(user_name,caption,link) VALUES('$value','$teks','$url')";
			$connect->query($qu);
			$comment = str_replace('@'.$value, '<b>'.$value.'</b>', $comment);
		}


		$q = "INSERT INTO comment(status_id, user_id, comment) VALUES('$id','$user_id','$comment')";
		$connect->query($q);
	echo $teks;
	}
}
?>
<form action="" method="post">
	<input type="text" placeholder="Comment" class="input-comment" id="cmt" name="comment">
</form>
<div class="comment">
	<?php 
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
		$q =$connect->query("SELECT * FROM status s INNER JOIN users u ON u.id = s.sender_id WHERE sender_id = '$id'");
		$r = $q->fetch_assoc();
		?><p><a href="#" class="me"><?=$r['user']?></a><?=$r['caption']?></p>
		<br>
		<?php 
		$q = $connect->query("SELECT u.user,c.comment FROM comment c LEFT JOIN users u ON u.id=c.user_id WHERE c.status_id = '$id' ORDER BY c.id DESC");
		while($row = $q->fetch_assoc()){
			$cl = '';
			if($result['user'] != $row['user']){
				$cl = 'onclick="document.getElementById('."'cmt'".').value += '."'@".$row['user']."'".'"';
			}
			?>
			<div class="comment-box">
			<p><a href="#"><?=$row['user']?></a><?=$row['comment']?><br><a href="javascript:void(0)" <?=$cl?>><small><i class="fas fa-reply"></i> Reply</small></a></p>
		</div>
			<?php
		}
	}
	?>
</div>