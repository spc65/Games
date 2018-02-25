<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Signup</title>
<link href="signup.css" type="text/css" rel="stylesheet" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<?php
	require("../../includes.php");
?>
</head>
<body>
  <?php
  	require('../header/header.php');
  ?>
	<script type="text/javascript" src="signup-script.js"></script>
	<div class="col-sm-12" style="height: 10vh;"></div>
	<div class="col-sm-4"></div>

	<div class="col-sm-4 well" ng-app="signup" ng-controller="signupctrl">
		<form ng-form-commit method="post" action="../../api/signup.php" name="newUserForm">
			<h4>Create Account</h4>
			<?php
				if(isset($_GET["error"])){
					echo '<p class="text-danger">'.$_GET["error"].'</p>';
	      }
			 ?>
			<div class="form-group">
				<label for="usr">Username:</label>
				<input type="text" class="form-control" id="usr" name="username" pattern=".{4,}" required>
			</div>
			<!-- <div ng-class="emailclass">
				<label for="pwd">Email:</label>
				<input type="email" class="form-control" id="pwd" name="email" ng-model="email" required>
				<p class="text-danger" ng-if="invalidEmail">Enter a valid email address</p>
			</div> -->
			<div ng-class="password1class">
				<label for="pwd">Password:</label>
				<input type="password" class="form-control" id="pwd" name="password1" ng-model="password1" pattern=".{6,}" required>
			</div>
			<div ng-class="password2class">
				<label>Re-enter password:</label>
				<input type="password" class="form-control" name="password2" ng-model="password2" pattern=".{6,}" required>
			</div>
			<p class="text-danger" ng-if="passwordsDontMatch">Passwords must match</p>

			<button type="button" ng-click="attempt(newUserForm)" class="btn btn-primary btn-block">Sign up</button>
			<hr />
			Already have an account? <a href="../login/login.php">Sign in</a>
		</form>
	</div>
	<div class="col-sm-4"></div>

</div>


</body>
</html>
