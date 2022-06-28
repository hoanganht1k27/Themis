<?php
if(isset($_GET['upload']))
{
  if($_GET['upload'] == "invalid")
   echo "<script>alert('You have to choose an image file to upload your avatar');window.location = 'profile.php';</script>";
  else
   echo "<script>alert('Upload successfully!!');window.location = 'profile.php';</script>";
}
include "layout.php";
?>
<head>
	<link rel="stylesheet" type="text/css" href="Css/profile.css">
</head>
<!-- Your profile -->
      <div class="profile-container">
        <h1>Welcome to your profile</h1>
        <hr>
        <div class="profile">
          <div class="profile-left">
            <div class="main-info" style="margin-bottom: 30px;">
              <h4 style="color: blue;">Expert</h4>
              <h3><a href="#" style="color: blue;"><?php echo $_SESSION['username'] ?></a></h3>
            </div>
            <ul class="par-info">
              <li>
                <p id="fullname">Full name: <?php echo $_SESSION['username'] ?></p>
              </li>
              <li>
                <p id="class">From Class: 11T1</p>
              </li>
              <li>
                <p id="email">Email: hoanganh8d@gmail.com</p>
              </li>
              <li>
                <p id="facebook">Contact <a href="https://www.facebook.com/profile.php?id=100022791520615">Anh Nguyen</a></p>
              </li>
            </ul>
            <button class="change-pass" style="padding: 10px; border: 1px solid black;">Change your password</button>
          </div>
          <div class="profile-right">
            <div class="ava-container">
              <?php
              include "get-ava-dir.php";
              ?>
              <img src="<?php echo $ava_dir?>">
              <hr>
              <span style="display: block;text-align: center;" id="change-ava">Change your ava</span>
              <div style="overflow: hidden;">
                <form class="change-ava animate" enctype="multipart/form-data" action="upload-ava.php" method="POST">
                  <input type="file" name="ava-file">
                  <small style="margin-bottom: 15px;">Your can choose any one you want</small>
                  <br>
                  <input type="submit" name="ava-submit" value="Upload" style="margin-top: 15px; padding: 5px;border: 1px solid grey;">
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-pass">
        <div class="modal-pass">
          <!-- <div style="width: 100%;overflow: hidden; margin-bottom: 10px;">
              <button id="confirm-close" style="padding: 7px 10px; background-color: red; color: white; float: right; border-radius: 4px;">&times;</button>
          </div> -->
          <form action="confirm.php" method="post" class="confirm-animate">
            <p>Your old password:</p>
            <input type="password" name="old-pass" id="old-pass" class="ip-pass">
            <?php
            if(isset($_GET['confirm'])){
              if($_GET['confirm'] == 'invalid')
              {
              echo "<script>
              $('.bg-pass').show();
              $('.modal-pass').show();
              </script>";
              echo "<span style='color: red;margin-bottom: 20px; display: block;'>Your old password is not correct!!!</span>";
              }
              else
              echo "<script>alert('Change password success!!!')</script>";
            }
            ?>
            <p>Your new password:</p>
            <input type="password" name="new-pass" id="new-pass" class="ip-pass">
            <p>Confirm your new password:</p>
            <input type="password" name="confirm-new-pass" id="confirm-new-pass" class="ip-pass">
            <input type="submit" value="Confirm" id="submit-new-pass">
          </form>
        </div>
      </div>
      <script type="text/javascript">
      $(document).ready(function() {
        //$('.user-info a').css('background-color', '#26ab2b');
        $('html').animate({scrollTop: 1000}, 0.3);
        $("#change-ava").click(function(event) {
          $(this).hide();
          $('.change-ava').show();
        });
        $('.change-pass').click(function(event) {
          $('.bg-pass').show();
          $('.modal-pass').show();
        });
        // $('#confirm-close').click(function(event) {
        //   $('.bg-pass').hide();
        //   $('.modal-pass').hide();
        // });
        $('.bg-pass').click(function(event) {
          var target = $(event.target);
          var check1 = target.closest('.modal-pass form').length;
          if(check1 == 0)
          {
            $(this).hide();
            $('.modal-pass').hide();
          }
        });
      });
    </script>