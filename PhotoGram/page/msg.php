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

$me = $result['id'];
//Access-Control-Allow-Origin header with wildcard.
header('Access-Control-Allow-Origin: *');
header('Content-type: text/html');
if(isset($_POST['id'])){
							$id = filter($_POST['id']); //he

							if($id != ''){
								$q = $connect->query("SELECT * FROM message WHERE msg_send = '$me' AND msg_receive = '$id' OR  msg_send = '$id' AND msg_receive = '$me'");
								while($rowss = $q->fetch_assoc()){
									$date = strtotime($rowss['datetime']);
									$d1 = new Datetime($rowss['datetime']);
								// date('H', $date)
									$d2 = new Datetime(date('Y-m-d H:i:s'));
									$dy = $d1->diff($d2)->y;
									$dm = $d1->diff($d2)->m;
									$dd = $d1->diff($d2)->d;
									$dh = $d1->diff($d2)->h;
									$di = $d1->diff($d2)->i;
									$ds = $d1->diff($d2)->s;
									echo '<div class="text-warning msg-alert" align="center">';
									if($dy=='0'){
										if($dm=='0'){
											if($dd == '0'){
												if($dh!= '0'){
													echo $dh.' jam yang lalu';
												}
											}else{
												echo $dd.' hari yang lalu';
											}
										}else{
											echo $dm.'bulan yang lalu';
										}
									}else{
										echo $dy.' tahun yang lalu';
									}
									echo '</div>';
									if($rowss['msg_send'] == $result['id']){
										echo '<div class="chat chat-me">'.$rowss['message'].'<br/><span class="time">'.$di.'menit&nbsp;&nbsp;'.$ds.'detik yang lalu</span></div>';
									}else{
										echo '<div class="chat chat-friend">'.$rowss['message'].'<br/><span class="time">'.$di.'menit&nbsp;&nbsp;'.$ds.'detik yang lalu</span></div>';
									}
								}
							}else{
								echo '<div class="jumbotron" align="center">
								<h2>No message <i class="fa fa-times"></i></h2>
								<p>Please choose partner to message now!</p>
								</div>';
							}
						}else{
							echo '<div class="jumbotron" align="center">
							<h2>No message <i class="fa fa-times"></i></h2>
							<p>Please choose partner to message now!</p>
							</div>';
						}
						?>