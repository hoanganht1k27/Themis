<?php
session_start();
if(isset($_SESSION["username"]))
{
	header("Location:index.php");
	exit();
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="Css/login.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <div class="bg">
		<div class="container">
		<div class="header">
			<img src="image/themis1.jpg">
		</div>
		<h3 style="text-align: center;">Welcome to your world!!!</h3>
	    <form class="form-lg" action="db_connect.php" method="post">
	    	<h4>User name:</h4>
	    	<input type="text" name="username" id="username" class="input">
	    	<h4>Password:</h4>
	    	<input type="password" name="password" id="password" class="input">
	    	<?php
	    	if(isset($_GET['login']))
	    	{
	    		if($_GET['login'] == 'invalid')
	    		echo "<p style='color: red;'>Username or password is not correct!!!</p>";
	    	    if($_GET['login'] == 'empty')
	    	    echo "<p style='color: red;'>Username or password can not be empty!!!</p>";
	    	}
	    	?>
	    	<input type="submit" name="submit" value="Login" id="submit">
	    </form>
	</div>
	</div>
</body>
</html>