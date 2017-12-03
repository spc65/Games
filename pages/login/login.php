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
		<form action="../../api/login.php" method="post">
			<?php
				if(isset($_GET["error"])){
					echo '<p class="text-danger">'.$_GET["error"].'</p>';
				}
			 ?>
			<div class="form-group">
				<label>Username:</label>
				<input type="text" name="username" class="form-control" id="username" required>
			</div>
			<div class="form-group">
				<label>Password:</label>
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
