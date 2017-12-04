<?php
//
// Steven Cleary
//
include 'DatabaseAdaptor.php';


// $hello = "hello world";
// if(isset($_GET["type"])){
//   if($_GET["type"] == "allquotes"){
//     $arr = $theDBA->getQuotesAsArray();
//     echo json_encode($arr);
//   }else if($_GET["type"] == "upvote"){
//     $theDBA->upVote(intval($_GET["id"]));
//   }else if($_GET["type"] == "downvote"){
//     $theDBA->downVote(intval($_GET["id"]));
//   }else if($_GET["type"] == "flag"){
//     $theDBA->flag(intval($_GET["id"]));
//   }else if($_GET["type"] == "logout"){
//     session_start();
//   	if(isset($_SESSION['username'])){
//       unset($_SESSION['username']);
//       header('Location: index.php');
//       die();
//     }
//   }else if($_GET["type"] == "unflagall"){
//     return $theDBA->unflagAll();
//   }
// }

function insertNewUser($username, $password){
  $theDBA = new DataBaseAdaptor();
  if($theDBA->register($username, $password) == "uae"){
    header('Location: ../pages/signup/signup.php?error=user already exists');
    die();
  }else{
    $theDBA->login($username, $password);
    session_start();
    $_SESSION['username'] = $username;
    header('Location: ../pages/account/account.php');
    die();
  }
}

function loginUser($username,$password){
  $theDBA = new DataBaseAdaptor();
  $msg = $theDBA->login($username, $password);
  if($msg == "username does not exist" or $msg == "incorrect password"){
    header('Location: ../pages/login/login.php?error='.$msg);
    die();
  }else{
    session_start();
    $_SESSION['username'] = $msg;
    header('Location: ../pages/account/account.php');
    die();
  }
}

function createGame($ch, $a, $word) {
  $theDBA = new DataBaseAdaptor();
  $game_id = $theDBA->createGame($ch, $a, $word);
  header('Location: ../pages/play/play.php?id='.$game_id);
  die();
}

function getGames($username) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->getGames($username);
}

function getWord($gameid) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->getWord($gameid);
}

function getLives($gameid) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->getLives($gameid);
}

function getLettersUsed($gameid) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->getLettersUsed($gameid);
}

function guess($gameid, $letter) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->guess($gameid,$letter);
}

function didWin($gameid) {
  $theDBA = new DataBaseAdaptor();
  return $theDBA->didWin($gameid);
}




?>
