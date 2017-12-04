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

// Adds the desired letter to the game's
// list of used letters and updates the
// number of mistakes made in the game,
// and determines if the game was won, lost,
// or is continuing.
function guess($gameid, $letter) {

  // Add the letter to the list of used letters
  $stmt = $this->DB->prepare("UPDATE game SET letters_used = letters_used + " . "'" . $letter . "' WHERE game_id = " . $gameid . ";");
  $stmt->execute();

  // Was this a mistake? Get the word and the letters used to find out.
  $stmt2 = $this->DB->prepare("SELECT word, letters_used FROM game WHERE game_id =" . $gameid);
  $stmt2->execute();
  $results = $stmt2->fetchAll(PDO::FETCH_ASSOC);
  $word = $results['word'];
  $letters = $results['letters_used'];

  // If the letter is not found in the word
  if (strpos($word, $letter) == FALSE) {

    // Vars
    $stmt3 = $this->DB->prepare("UPDATE game SET num_mistakes = num_mistakes + 1 WHERE game_id = " . $gameid);

    // Did we lose? Need 6 mistakes to lose
    if ($results['num_mistakes'] == 5) {

      $stmt3 = $this->DB->prepare("UPDATE game SET num_mistakes = num_mistakes + 1, won = 0, over = 1 WHERE game_id = " . $gameid);
    }

    $stmt3->execute();
  }

  // Need to find out if we won
  else {

    $result = '';

    // Let's determine the player's word progress
    for ($i = 0; $i < strlen($word); $i++) {

      // Did they use this letter?
      if (strpos($letters, $word[$i])) {

        $result .= $word[$i];
      }

      // Blank
      else {

        $result .= '-';
      }
    }

    // Do we have any dashes?
    if (strpos($word, '-') == FALSE) {

      // Ding ding ding! You win!
      $stmt4 = $this->DB->prepare("UPDATE game SET won = 1, over = 1 WHERE game_id = ". $gameid);
      $stmt4->execute();
    }
  }

  // Return the word progress
  return getWord($gameid);
}




?>
