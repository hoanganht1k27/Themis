<?php
session_start();
if(!isset($_SESSION['username'])) header("Location:login.php");
?>

<!DOCTYPE html>
<html>
<head>
  <title>RANKING</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="lib/bootstrap_source/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
  <style type="text/css">
  	*{
  		font-family: 'Roboto', sans-serif;
  	}
  	#ranking{
  		min-width: 4000px;
  		padding: 0px 20px;
  		box-sizing: border-box;
  	}
  	table,th,td{
  		border: 2px solid #6b736b;
  	}
  	table{
  		background-color: #eaea1f59;
  	}
  	.td{
  		width: 150px!important;
  		text-align: center;
  		padding: 0px;
  		height: 50px;
  		box-sizing: border-box;
  	}
  	.td a{
  		display: block;
  		width: 100%;
  		height: 100%;
  		border-radius: 4px;
  		padding: 10px;
  		vertical-align: middle;
  		color: white;
  	}
  	.td a:hover{
  		text-decoration: none;
  		color: grey;
  	}
    .td-sum{
    background-color: #38a7b5;
    border-radius: 8px;
    color: white;
    }
    span.so-lan-nop {
        font-size: 12px;
        color: black;
        display: inline-block;
        padding: 5px; 
    }
  	</style>
</head>
<body>
	<h1 style="text-align: center;">Ranking</h1>
    <div id="ranking"></div>
    <script type="text/javascript" src="Js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="lib/bootstrap_source/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Js/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
	<script type="text/javascript">
		function Ajax()
		{
			var xhttp = new XMLHttpRequest();
			xhttp.onreadystatechange = function()
			{
				if(this.readyState == 4)
				{
              document.getElementById('ranking').innerHTML = this.responseText;
              if(this.responseText == "<h1>Ranking hiện không khả dụng</h1>")
              {
                window.location = "login.php";
              }
              else
              setTimeout('Ajax()',1000);
				}
			};
			xhttp.open("GET","ranking.php",true);
			xhttp.send();
		}
		window.onload = function()
		{
			Ajax();
		}
		function wload(url)
		{
			console.log(url);
			window.open(url,'','width=600px, height= 400px, left= 100px, top= 100px');
		}
	</script>
</body>
</html>