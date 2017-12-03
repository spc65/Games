

<?php
	include 'controller.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_POST["username"];
		$password1 = $_POST["password1"];
  	$password2 = $_POST["password2"];

		if(ctype_alpha(str_replace(' ', '', $username)) === false){
			//name can only contain letters and spaces
			header('Location: ../pages/signup/signup.php?error=username invalid');
			die();
		}else{
			if($password1 !== $password2){
				//passwords are not the same
				//require('error/passwords-dont-match.html');
				header('Location: ../pages/signup/signup.php?error=passwords dont match');
		    die();
			}else{
						insertNewUser($username,$password1);
			}
		}
	}else{
		require('../pages/signup/signup.php');
	}


?>
