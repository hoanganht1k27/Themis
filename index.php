<?php
session_start();
?>
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
    <?php
    if(!isset($_SESSION["username"]))
      {header("Location:login.php");exit();}
    ?>
    <?php
    if(isset($_GET['limit']))
    {
      echo "<script>alert('You can\'x`submit more!!!'); window.location='index.php'</script>";
    }
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
            <a href="index.php" style=" background-color: #008000">Home</a>
          </li>
        </ul>
        <button class="dropdown">
          <i class="fas fa-caret-down"></i>
        </button>
        <div class="user-info">
          <?php
          // $conn = mysqli_connect('localhost','pma','hoanganht1k271112002','themis');
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
            <a href="index.php" style=" background-color: #26ab2b">Home</a>
          </li>
        </ul>
    </div>
    <!-- Image hacker -->
    <div class="img-hacker" style="position: relative;">
      <img src="image/themis4.jpg" style="width: 100%; height: 500px;">
      <i style="position: absolute; right: 0px; bottom: 0px; color: grey; padding: 20px;">The best way to know your future is creating it!!!</i>
    </div>
    <!-- All Page -->
    <div class="page">
      <div class="page-third">
        <h1 class="page-header">
          Đề bài
        </h1>
        <div style="width: 100%; height: 5px; background-color: green; margin-bottom: 30px;"></div>
        <ul class="de-bai-list">
          <?php
          $a =glob("De bai/*");
          foreach ($a as $i => $dir) {
            $filename = basename($dir);
            echo "<li>
                    <a href='{$dir}' target='_blank'>{$filename}</a>
                  </li>";
          }
          ?>
        </ul>
      </div>
      <div class="page-third">
        <h1 class="page-header">
          Test
        </h1>
        <div style="width: 100%; height: 5px; background-color: green; margin-bottom: 30px;"></div>
        <ul class="test-list">
          <!-- <li class="particular-test">
            <h4>Treasure</h4>
            <hr>
            <ul class="test">
              <li>
                <a href="Test/Treasure/Test00/">Test00</a>
              </li>
              <li>
                <a href="Test/Treasure/Test00/">Test00</a>
              </li>
              <li>
                <a href="Test/Treasure/Test00/">Test00</a>
              </li>
              <li>
                <a href="Test/Treasure/Test00/">Test00</a>
              </li>
              <li>
                <a href="Test/Treasure/Test00/">Test00</a>
              </li>
            </ul>
          </li> -->
          <?php
          $a = glob("Test/*");
          foreach ($a as $i => $dir) {
            $test_name = stripcslashes(basename($dir));
            $b = glob("{$dir}/*");
            $n_echo = "<li class='particular-test'>
            <h4>{$test_name}</h4>
            <hr>
            <ul class='test'>";
            foreach ($b as $j => $par_dir) {
              $test_id = stripcslashes(basename($par_dir));
              $n_echo .= "<li>
                          <a href='{$par_dir}/' target='_blank')>{$test_id}</a>
                         </li>";
            }
            $n_echo .= "</ul>
          </li>";
          echo $n_echo;
          }
          ?>
        </ul>
      </div>
      <div class="nop-bai">
        <h1>Nộp bài</h1>
        <form id="nop-bai" action="upload.php" enctype="multipart/form-data" method="post">
          <input type="file" name="file" id="file">
          <input type="submit" name="submit" value="Nộp" id="submit">
        </form>
        <div class="nhat-ky">
          <h3 style="padding: 20px 0px;">Nhật ký nộp bài</h3>
          <ul class="log-list">
            <li>
              <img src="image/load2.gif">
            </li>
            <!-- <li>
              <a href="#">TABLE</a>
              <div class="diem-container">
                <span style="background-color: #ad1111;" class="diem">100
                </span>
                <span class="so-lan-nop">1</span>
              </div>
            </li>
            <li>
              <a href="#">TABLE</a>
              <div class="diem-container">
                <span style="background-color: #ad1111;" class="diem">100
                </span>
                <span class="so-lan-nop">1</span>
              </div>
            </li>
            <li>
              <a href="#">TABLE</a>
              <div class="diem-container">
                <span style="background-color: #ad1111;" class="diem">100
                </span>
                <span class="so-lan-nop">1</span>
              </div>
            </li>
            <li>
              <a href="#">TABLE</a>
              <div class="diem-container">
                <span style="background-color: #ad1111;" class="diem">100
                </span>
                <span class="so-lan-nop">1</span>
              </div>
            </li> -->
          </ul>
        </div>
      </div>
    </div>
    <!-- Footer -->
    <div class="footer" style="background-color: #043c04a8; color: white; padding: 50px; text-align: center;">
      <h1>WORKING FOR PASSION</h1>
      <h6>Author: Anh Nguyen</h6>
    </div>
    <script type="text/javascript" src="Js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap_source/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="Js/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.3.5/jquery.fancybox.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/2.1.2/TweenMax.min.js"></script>
    <script type="text/javascript">
       //$('.user-wrapper li:nth-child(5) a').css('background-color', '#26ab2b');
       $(document).ready(function() {
         $('.dropdown').click(function(event) {
           $('.dropdown-wrapper').toggle();
         });
       });
       function Ajax()
         {
          var xhttp = new XMLHttpRequest();
          xhttp.onreadystatechange = function()
          {
             if(this.readyState == 4)
             {
                $('.log-list').html(this.responseText);
                //console.log(this.responseText);
                setTimeout('Ajax()',1000);
             }
          };
          xhttp.open("GET","data-rank.php",true);
          xhttp.send();
         }
         window.onload = function()
         {
           Ajax();
         }
         function wload(url)
         {
          window.open(url,'','width=600px, height= 400px, left= 100px, top= 100px');
         }
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