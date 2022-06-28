<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Trang chu</title>
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
    <?php
    if(!isset($_SESSION["username"]))
      {header("Location:login.php");exit();}
    ?>
    <!-- Navigation -->
        <div class="nav">
          <div class="navigation">
            <ul class="user-wrapper">
              <li>
                <a href="logout.php">Exit</a>
              </li>
              <li>
                <a href="#">Message</a>
              </li>
              <li>
                <a href="Chat-box.php">Chat box
                  <span id="notice">0</span>
                </a>
              </li>
              <li>
                <a href="rank.php" target="_blank">Ranking</a>
              </li>
              <li>
                <a href="index.php">Home</a>
              </li>
            </ul>
            <button class="dropdown">
              <i class="fas fa-caret-down"></i>
            </button>
            <div class="user-info">
              <?php
              //$conn = mysqli_connect('localhost','pma','hoanganht1k271112002','themis');
              require_once('ketnoi.php');
              if(!$conn){
                //echo "<h1>Can not upload your avatar</h1>";
                die("<h1>Can not upload your avatar</h1>");
              }
              else{
                $sql = "SELECT * FROM `all-user` WHERE `id` = {$_SESSION['id']}";
                $res = mysqli_query($conn,$sql);
                if(mysqli_affected_rows($conn)>=1)
                {
                  $row = mysqli_fetch_array($res);
                  $dir = $row['ava-dir'];
                  echo "<img src='{$dir}'>";
                }
              }
              ?>
              <a href="profile.php"><?php echo $_SESSION["username"] ?></a>
            </div>
        </div>
        <ul class="dropdown-wrapper">
            <li>
              <a href="logout.php">Exit</a>
            </li>
            <li>
              <a href="#">Message</a>
            </li>
            <li>
              <a href="Chat-box.php">Chat box</a>
            </li>
            <li>
              <a href="rank.php" target="_blank">Ranking</a>
            </li>
            <li>
              <a href="index.php">Home</a>
            </li>
          </ul>
      </div>
        <!-- Image hacker -->
        <div class="img-hacker" style="position: relative;">
          <img src="image/themis4.jpg" style="width: 100%; height: 500px;">
          <i style="position: absolute; right: 0px; bottom: 0px; color: grey; padding: 20px;">The best way to know your future is creating it!!!</i>
        </div>
        <script type="text/javascript" src="Js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap_source/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script type="text/javascript">
       $(document).ready(function() {
         $('.dropdown').click(function(event) {
           $('.dropdown-wrapper').toggle();
         });
       });
       function loadNotice()
          {
            $.ajax({
                url: "dem.txt",
                cache: false,
                success: function(html){    
                  $("#notice").html(html);    
                  },
              });
          }
        setInterval('loadNotice()',1000);
    </script>
</body>
</html>