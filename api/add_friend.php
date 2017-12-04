<?php
  ini_set('session.use_strict_mode', 1);
  session_start();
	include 'controller.php';
  $friendsName =  $_GET["fname"];
  if(isset($_SESSION['username'])){
    echo addFriend($_SESSION['username'],$friendsName);
  }
?>
