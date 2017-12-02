<?php
//
// Steven Cleary
//
include 'DatabaseAdaptor.php';

$theDBA = new DataBaseAdaptor();
$hello = "hello world";
if(isset($_GET["type"])){
  if($_GET["type"] == "allquotes"){
    $arr = $theDBA->getQuotesAsArray();
    echo json_encode($arr);
  }else if($_GET["type"] == "upvote"){
    $theDBA->upVote(intval($_GET["id"]));
  }else if($_GET["type"] == "downvote"){
    $theDBA->downVote(intval($_GET["id"]));
  }else if($_GET["type"] == "flag"){
    $theDBA->flag(intval($_GET["id"]));
  }else if($_GET["type"] == "logout"){
    session_start();
  	if(isset($_SESSION['username'])){
      unset($_SESSION['username']);
      header('Location: index.php');
      die();
    }
  }else if($_GET["type"] == "unflagall"){
    return $theDBA->unflagAll();
  }
}
if(isset($_POST["new_name"]) && isset($_POST["new_password"])){
  if($theDBA->register($_POST["new_name"], $_POST["new_password"]) == "uae"){
    header('Location: register.php?error=user already exists');
    die();
  }else{
    header('Location: index.php');
    die();
  }
}

if(isset($_POST["name"]) && isset($_POST["password"])){
  $msg = $theDBA->login($_POST["name"], $_POST["password"]);
  if($msg == "username does not exist" or $msg == "incorrect password"){
    header('Location: login.php?error='.$msg);
    die();
  }else{
    session_start();
    $_SESSION['username'] = $msg;
    header('Location: index.php');
    die();
  }
}

if(isset($_POST["author"]) && isset($_POST["quote"])){
    $theDBA->newQuote($_POST["quote"], $_POST["author"]);
    header('Location: index.php');
    die();
}

?>
