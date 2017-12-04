<?php
  ini_set('session.use_strict_mode', 1);
  session_start();
	include 'controller.php';
  $gameid = $_GET["id"];
  // echo $gameid;
  // echo $gameid;
  echo '{"word":"'.htmlspecialchars(getWord($gameid)).'","lives":"'.htmlspecialchars(getLives($gameid)).'","letters_used":"'.htmlspecialchars(getLettersUsed($gameid)).'"}';
?>
