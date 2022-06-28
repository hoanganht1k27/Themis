<?php
session_start();
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $old_pass = $_POST['old-pass'];
    if($old_pass!=$_SESSION['password']){
    	header("Location:profile.php?confirm=invalid");
    	exit();
    }
    else{
    	require_once('ketnoi.php');
		if(!$conn){
			die("Connect failed");
		}
		else{
			$sql = "UPDATE `all-user` SET `password` = '{$_POST['new-pass']}' WHERE `id` = '{$_SESSION['id']}'";
			$res = mysqli_query($conn, $sql);
			if(mysqli_affected_rows($conn)>=1 || $_SESSION['password'] == $_POST['new-pass'])
			{
				$_SESSION['password'] = $_POST['new-pass'];
				mysqli_close($conn);
				header("Location:profile.php?confirm=success");
    	        exit();
			}
			else
			{
				echo $_POST['new-pass'];
			}
		}
    }
}
?>