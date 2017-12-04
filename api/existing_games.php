
<?php
  ini_set('session.use_strict_mode', 1);
  session_start();
	include 'controller.php';
  if(isset($_SESSION['username'])){
    echo(getGames($_SESSION['username']));
  }




?>
