<?php
    session_start();
	//include_once("db_connect.php");
	// $servername = "localhost";
	// $username = "pma";
	// $password = "hoanganht1k271112002";
	// $dbname = "themis";
	// $conn = mysqli_connect($servername,$username,$password,$dbname);
	require_once('ketnoi.php');
	if(!$conn){
		die("Connect failed");
	}
	else{
		if($_SERVER["REQUEST_METHOD"]=="POST")
		{
			$user = $_POST['username'];
			$pass = $_POST['password'];
			if(!empty($user)&&!empty($pass))
			{
				$sql = "SELECT * FROM `all-user` WHERE username = '{$user}' AND password = '{$pass}'";
				$res = mysqli_query($conn,$sql);
				if(mysqli_affected_rows($conn)>=1){
					$_SESSION["username"] = $user;
					$_SESSION["password"] = $pass;
					$row = mysqli_fetch_array($res);
					$_SESSION["id"] = $row['id'];
					$_SESSION["full-name"] = $row['full name'];
					$_SESSION["limit"] = $row['limit'];
					$dir = "User/{$_SESSION['id']}/";
					if(!is_dir($dir))
					mkdir($dir);
					header("Location:index.php");
				}
				else{
					header("Location:login.php?login=invalid");
				}
			}
			else
			{
				header("Location:login.php?login=empty");
			}
		}
	}
	?>