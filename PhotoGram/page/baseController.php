<?php 
function uploadImage($name = '',$dir = 'upload/',$max = 500000){
	$msg = '';
	$target = '';
	$target_dir = $dir;
	$target_file = $target_dir . basename($_FILES[$name]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
	$check = getimagesize($_FILES[$name]["tmp_name"]);
		if($check !== false) {
			$msg =  "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$msg =  "File is not an image.";
			$uploadOk = 0;
		}
// Check if file already exists
	if (file_exists($target_file)) {
		$msg =  "Sorry, file already exists.";
		$uploadOk = 0;
	}
// Check file size
	if ($_FILES[$name]["size"] > $max) {
		$msg =  "Sorry, your file is too large.";
		$uploadOk = 0;
	}
// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
		&& $imageFileType != "gif" ) {
		$msg =  "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	$uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	$msg =  "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
	$target = $target_dir . generateToken(32).'.'.$imageFileType;
	if (move_uploaded_file($_FILES[$name]["tmp_name"], $target)) {
		$msg =  $target_file;
	} else {
		$msg =  "Sorry, there was an error uploading your file.";
	}
}
return ['status'=>$uploadOk,'message'=>$msg,'file'=>$target];
}
function generateToken($lenght){
	$key = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVXYZ1234567890";
	$token = '';
	for($i = 0;$i < $lenght;$i++){
		$token .= $key{rand(0,strlen($key)-1)};
	}
	return $token;
}
function alert($str=''){
	echo '<script>alert("'.$str.'");</script>';
}
function redirect($str=''){
	echo '<script>window.location.href = "'.$str.'";</script>';
}
?>