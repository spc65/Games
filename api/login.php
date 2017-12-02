
<?php
	include 'controller.php';
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_POST["username"];
		$password1 = $_POST["password1"];
  	$password2 = $_POST["password2"];
		$email = $_POST["email"];
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
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					//not a valid email
					header('Location: ../pages/signup/signup.php?error=invalid email');
			    die();
				}else{
					if(findUser($email)){
						//email already has account linked
						header('Location: ../pages/signup/signup.php?error=email already in use');
						die();
					}else{
						insertNewUser($username,$password1,$email);
					}
				}
			}
		}
	}else{
		require('../pages/signup/signup.php');
	}


?>
