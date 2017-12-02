<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="index.css" />

<title>Hangman!</title>
<?php
	require("../../includes.php");
?>
</head>
<body>

  <?php
  	require('../header/header.php');
  ?>

    <div class="indexGrid">

      <div class="login login_and_signup" onclick="window.location.href = '../login/login.php';">
        <span>Login</span>
      </div>
      <div class ="signup login_and_signup" onclick="window.location.href = '../signup/signup.php';">
        <span>Signup</span>
      </div>
    </div>



</body>
</html>
