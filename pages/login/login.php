<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Login</title>
<link href="login.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
	require("../../includes.php");
?>
</head>
<body>
  <?php
  	require('../header/header.php');
  ?>
	<div class="col-sm-12" style="height: 10vh;"></div>
	<div class="col-sm-4"></div>

	<div class="col-sm-4 well">
		<div id="toChange">
		<h4>Sign in</h4>
		<form action="api/login-controller.php" method="post">
			<div class="form-group">
				<label>Email:</label>
				<input type="text" name="email" class="form-control" id="email" required>
			</div>
			<div class="form-group">
				<label>Password: (not a secure connection)</label>
				<input type="password" name="password" class="form-control" id="password" maxlength="128" required>
			</div>
			<button type="submit" class="btn btn-primary btn-block" >Login</button>
		</form>
		<hr />
		Don't have an account? <a href="../signup/signup.php"> create a new account </a>
</div>
	</div>
	<div class="col-sm-4"></div>


</body>
</html>
