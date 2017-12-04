<?php
  ini_set('session.use_strict_mode', 1);
  session_start();
	include 'controller.php';
  $friendsName =  $_GET["fname"];
  $word =  $_GET["word"];

  if(isset($_SESSION['username'])){
    createGame($_SESSION['username'],$friendsName,$word);
  }
?>
