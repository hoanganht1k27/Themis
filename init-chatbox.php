<?php
session_start();
$fi = fopen('log.txt', 'r');
$prev = '';
while(!feof($fi))
{
	$row = explode(':', fgets($fi));
	if(sizeof($row) == 1) break;
	$servername = "localhost";
	$username = "pma";
	$password = "hoanganht1k271112002";
	$dbname = "themis";
	$conn = mysqli_connect($servername,$username,$password,$dbname);
	if(!$conn){
		die("Connect failed");
	}
	else{
		$sql = "SELECT * FROM `all-user` WHERE `username` = '{$row[0]}'";
		$res = mysqli_query($conn,$sql);
		if(mysqli_affected_rows($conn)>=1)
		{
			$dir = mysqli_fetch_array($res)['ava-dir'];
		}
		mysqli_close($conn);
	}
	$margin = '20px';
	if($row[0] == $prev) $margin = '0px';
	if($row[0] == $_SESSION['username'])
	{
		echo '<div class="user-type-2" style="margin-top: '.$margin.'">
	  	   		<p style="padding: 10px; background-color: #036a77; color: white; margin: 0; display: inline-block; float: right;">'.$row[1].'</p>
	  	   	</div>';
	}
	else
	{
		if($row[0] != $prev)
		echo '<div class="user-type-1" style="margin-top: '.$margin.'">
	  	   		<div style="height: 30px; margin-bottom: 10px;">
	  	   			<img src='.$dir.' style="height: 100%; width: 30px;">
	  	   			<span><b>'.$row[0].'</b></span>
	  	   		</div>
	  	   		<p style="padding: 10px; background-color: #00c1da; color: white; margin: 0; display: inline-block; float: left;">'.$row[1].'</p>
	  	   	</div>';
	  	else
	  	echo '<div class="user-type-1" style="margin-top: '.$margin.'">
	  	   		<p style="padding: 10px; background-color: #00c1da; color: white; margin: 0; display: inline-block; float: left;">'.$row[1].'</p>
	  	   	</div>';
	}
	$prev = $row[0];
}
?>