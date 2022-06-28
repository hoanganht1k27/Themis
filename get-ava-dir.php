<?php
    require_once('ketnoi.php');
	if(!$conn){
		die("Connect failed");
	}
	else{
       $sql = "SELECT  * FROM `all-user` WHERE `id` = '{$_SESSION['id']}'";
       $res = mysqli_query($conn,$sql);
       if(mysqli_affected_rows($conn)>=1)
       {
          $row = mysqli_fetch_array($res);
          $ava_dir = $row['ava-dir'];
       }
	}
?>