<?php

include 'data-read.php';

session_start();

  if (isset($_POST['email']) && isset($_POST['password'])){
  	
  	$arr = $theDBAR->getUser(htmlspecialchars($_POST['email']));

  	if (count($arr) == 0){
  		echo 'nothing found';
  		$userErr = 'invalid username';
 		header ('Location: login.php');
 	}else{
 		$dbpassword = $arr[0]['password'];
  		if (password_verify($_POST['password'] , $dbpassword)){
  			$_SESSION['email'] = $arr[0]['email'];
			$_SESSION['username'] = $arr[0]['username'];
  			header('Location: ../index.php');
  		}else{
  			header('Location: ../login.php');
 		}
 	}
 }
	
?>