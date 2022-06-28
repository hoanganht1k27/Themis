<?php
session_start();
if(isset($_POST['ava-submit']))
{
$check = getimagesize($_FILES['ava-file']['tmp_name']);
if(!$check){
	header("Location:profile.php?upload=invalid");
	exit();
}
else{
    require_once('ketnoi.php');
	if(!$conn){
		header("Location:profile.php?connect=failed");
		die("Connect failed");
	}
	else{
		$target_file = "User/{$_SESSION['id']}/img1.jpg";
		unlink($target_file);
		move_uploaded_file($_FILES['ava-file']['tmp_name'], $target_file);
		$sql = "UPDATE `all-user` SET `ava-dir` = '{$target_file}' WHERE `id` = {$_SESSION['id']}";
		$res = mysqli_query($conn,$sql);
		if($res){
			header("Location:profile.php?upload=success");
		}
	}
}
}
?>