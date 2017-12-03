
<?php
	include 'controller.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_POST["username"];
		$password = $_POST["password"];
		loginUser($username,$password);
		// echo $username;
		// echo $password;
	}else{
		require('../pages/signup/signup.php');
	}


?>
