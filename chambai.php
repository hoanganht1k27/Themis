<!DOCTYPE html>
<html>
<head>
  <title>Template-3-Blog</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="lib/bootstrap_source/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="Css/animate.css">
  <link rel="stylesheet" type="text/css" href="Css/style.css">
</head>
<body>
	<!-- <?php
	// if($_SERVER['REQUEST_METHOD']=='GET')
	// {
	// 	if(isset($_GET['type']))
	// 	{echo '<script type="text/javascript">
	// 	alert("Nop bai thanh cong");
	//     </script>';}
	// }
	?> -->
    <form action="upload.php" method="post">
    	<input type="file" name="file">
    	<button type="submit" id="submit">Nộp</button>
    </form>
    <button id="myBtn">Click here</button>
    <script type="text/javascript" src="Js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap_source/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
       	 	$('#myBtn').click(function(event) {
       	 		console.log($('input').val());
       	 	});
       	 	$('#submit').click(function(event) {
       	 		alert('nop bai thanh cong');       	 		
       	 	});
       });
    </script>
</body>
</html>