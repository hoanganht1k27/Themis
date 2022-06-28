<?php
session_start();
if(!isset($_SESSION['username'])) {header("Location:login.php");exit();}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Chat box</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="lib/bootstrap_source/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.css" />
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="Css/animate.css">
  <link rel="stylesheet" type="text/css" href="Css/Chat-box.css">
</head>
<body>
  <div class="bg">
  	<div class="chatbox-container">
  	   <div class="header">
  	   	<span>Welcome, <b><?php echo $_SESSION['username'] ?></b></span>
  	   	<button id="close"><i class="fas fa-power-off"></i></button>
  	   </div>
  	   <div class="chatbox-content"><!-- 
	  	   	<div class="user-type-1">
	  	   		<div style="height: 30px; margin-bottom: 10px;">
	  	   			<img src="no-ava.jpg" style="height: 100%; width: auto;">
	  	   			<span><b>T104 Nguyen Hoang Anh</b></span>
	  	   		</div>
	  	   		<p style="padding: 10px; background-color: #00c1da; color: white; margin: 0; display: inline-block; float: left;">putate eget! Distinctio tempore! Cumque magnis fugiat, saepe assumenda justo! Nascetur s</p>
	  	   	</div>
	  	   	<div class="user-type-2">
	  	   		<p style="padding: 10px; background-color: #036a77; color: white; margin: 0; display: inline-block; float: right;">putate eget! Distinctio tempore! Cumque magnis fugiat, saepe assumenda justo! Nascetur s</p>
	  	   	</div>
	  	   	<div class="user-type-2">
	  	   		<p style="padding: 10px; background-color: #036a77; color: white; margin: 0; display: inline-block; float: right;">okok</p>
	  	   	</div> -->
  	   </div>
  	   <div class="chatbox-input">
  	   	<form method="post">
  	   		<div class="msg">
             <input type="img" name="mess" placeholder="Write something !" id="msg">
             <button type="button" id="icon"><i class="fas fa-sad-tear"></i></button>
          </div>
  	   		<div style="text-align: center;">
  	   			<input type="submit" name="submit" value="Send" id="submit">
  	   		</div>
  	   	</form>
  	   </div>
  	</div>
  </div>
    <script type="text/javascript" src="Js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap_source/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script type="text/javascript">
    	//$(".bg").scrollTop(140);
    	$(".bg").animate({
        scrollTop: 140}, 500);
    	$(document).ready(function() {
    		$('#close').click(function(event) {
    			var a =window.confirm('Exit Chatbox???');
    			if(a == true){
    				window.location = 'index.php';
    			}
    		});
    	});
    	$(document).ready(function() {
    		$('#submit').click(function(event) {
    			event.preventDefault();
    			var msg = $('#msg').val();
    			$.post('post-chatbox.php', {mess: msg, type: 1}, loadLog);
    			$('#msg').val('');
    		});
        $('#icon').click(function(event) {
          $.post('post-chatbox.php', {mess: '<i class=\"fas fa-sad-tear\"></i>', type: 2}, loadLog);
        });
    	});
    var keepChat = '';
		function loadLog()
		{
			$.ajax({
              url: "post-chatbox.php",
              cache: false,
              success: function(html){ 
                if(html != keepChat)   
                {
                $(".chatbox-content").html(html); keepChat = html; 
                var h = $('.chatbox-content')[0].scrollHeight;
                // var H = $('.chatbox-content').scrollTop();
                // console.log(H+"   "+h);
                // if(H > h-300)
                $(".chatbox-content").animate({scrollTop: h}, 0.5);
                }
                if(html == "<h1>Chat box hiện không khả dụng!!!</h1>"){
                  window.location = "login.php";
                } 
                else
                setTimeout("loadLog()", 1000);   
                },
            });
		}
    loadLog();
		//setInterval("loadLog()", 1000);
    </script>
</body>
</html>