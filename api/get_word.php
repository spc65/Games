<?php
  ini_set('session.use_strict_mode', 1);
  session_start();
	include 'controller.php';
  $gameid = $_GET["id"];
  echo '{"word":"'.htmlspecialchars(getCorrectWord($gameid)).'"}';
?>
