<?php
//
// Steven Cleary
//
class DataBaseAdaptor {
  private $db;

  public function __construct(){
    $db = 'mysql:dbname=hangman; charset=utf8; host=127.0.0.1';
    $user = 'root';
    $password = '';
    try{
      $this->DB = new PDO($db, $user, $password);
      $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch(PDOException $e){
      echo('Error establishing Connection');
      exit();
    }
  }

  public function register($username, $password){
    $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username='".$username."';");
    $stmt->execute();
    $users = $stmt->fetchAll( PDO::FETCH_ASSOC );
    if(count($users) > 0){
      return "uae";
    }
    #$2y$10$r.MBLXzDunNgMZT0x2gyb.1b5lzNqMotOE8.ICrL1YTFpr/zEGB7.
    $hashed_pwd = password_hash($password, PASSWORD_DEFAULT);
    $stmt = $this->DB->prepare("INSERT INTO users(username,hash) VALUES('".$username."','".$hashed_pwd."');");
    $stmt->execute();
  }
  public function login($username, $password){
    $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username='".$username."';");
    $stmt->execute();
    $users = $stmt->fetchAll( PDO::FETCH_ASSOC );
    if(count($users) == 0){
      return "username does not exist";
    }
    #$hash = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password,$users[0]["hash"])){
      return $users[0]["username"];
    }else{
      return "incorrect password";
    }
  }
  function createGame($ch, $a, $word) {
    $ch_id = $ch;
    if($ch != "NULL"){// retrive users id by name
      $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username='".$ch."';");
      $stmt->execute();
      $ch_id = $stmt->fetchAll( PDO::FETCH_ASSOC )[0]["id"];
    }
    // retrive users id by name
    $stmt = $this->DB->prepare( "SELECT id FROM users WHERE username='".$a."';");
    $stmt->execute();
    $a_id = $stmt->fetchAll( PDO::FETCH_ASSOC )[0]["id"];
    $stmt = $this->DB->prepare("INSERT INTO game(challenger_id,acceptor_id, word, num_mistakes, letters_used, over, won) VALUES(".$ch_id.', '.$a_id.", '".$word."', 0,'', FALSE, 0);");
    $stmt->execute();
    return $this->DB->lastInsertId();
  }

  function getWord($gameId) {
    // Format our query and execute it
    $stmt = $this->DB->prepare("SELECT word, letters_used FROM game WHERE game_id = ".$gameId.';');
    $stmt->execute();
    // Get the word and the letters used so far
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    $word = $results['word'];
    $letters = $results['letters_used'];
    $result = '';
    // Let's determine the player's word progress
    for ($i = 0; $i < strlen($word); $i++) {
      // Did they use this letter?
      if (strpos($letters, $word[$i]) !== false || strpos(strtolower($letters), $word[$i]) !== false) {
        $result .= $word[$i];
      }else {// Blank
        $result .= '-';
      }
    }
    // Return the word progress
    return $result;
  }

  function getLettersUsed($gameId) {
    $stmt = $this->DB->prepare("SELECT letters_used FROM game WHERE game_id = ".$gameId.';');
    $stmt->execute();
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    $letters = $results['letters_used'];
    return $letters;
  }

  function getGames($username) {
    // Format our query and execute it
    $stmt = $this->DB->prepare("SELECT * FROM game INNER JOIN users ON users.id=game.acceptor_id WHERE username='".$username."' ;");
    $stmt->execute();
    $outp = "";
    $all = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($all as $rs) {
      if ($outp != "") {$outp .= ",";}
      $word = $rs['word'];
      $letters = $rs['letters_used'];
      $result = '';
      for ($i = 0; $i < strlen($word); $i++) {
        if (strpos($letters, $word[$i]) !== false || strpos(strtolower($letters), $word[$i]) !== false) {
          $result .= $word[$i];
        }else {// Blank
          $result .= '-';
        }
      }
      $outp .= '{"game_id":"'.$rs["game_id"].'",';
      $outp .= '"challenger_id":'.(($rs["challenger_id"] === NULL)? '"single player"':$rs["challenger_id"]).',';
      $outp .= '"mistakes":'.$rs["num_mistakes"].',';
      $outp .= '"over":'.$rs["over"].',';
      $outp .= '"won":'.$rs["won"].',';
      $outp .= '"progress":"'.$result.'"}';
    }
    //$outp ='{"hits":'.$hits.',"foods":['.$outp.']}';
    $outp ='{"games":['.$outp.']}';
    //$outp ='{"data":['.print_r($stmt->fetchAll(PDO::FETCH_ASSOC)).']}';
    return $outp;
  }

  // Returns the number of lives the player has given
  // the game id provided by the client.
  function getLives($gameid) {
    // Query the db
    $stmt = $this->DB->prepare("SELECT num_mistakes FROM game WHERE game_id = " . $gameid);
    $stmt->execute();
    // Grab the results of the query
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC)[0];
    // Return the number of lives the player has left
    return 6 - $results['num_mistakes'];
  }
  // Adds the desired letter to the game's
  // list of used letters and updates the
  // number of mistakes made in the game,
  // and determines if the game was won, lost,
  // or is continuing.
  function guess($gameid, $letter) {
    // Add the letter to the list of used letters
    $stmt = $this->DB->prepare("UPDATE game SET letters_used = CONCAT(letters_used,'" . $letter . "') WHERE game_id = " . $gameid . ";");
    $stmt->execute();
    // Was this a mistake? Get the word and the letters used to find out.
    $stmt2 = $this->DB->prepare("SELECT word, letters_used, num_mistakes FROM game WHERE game_id =" . $gameid);
    $stmt2->execute();
    $results = $stmt2->fetchAll(PDO::FETCH_ASSOC)[0];
    $word = $results['word'];
    $letters = $results['letters_used'];
    // If the letter is not found in the word
    if (strpos($word,$letter) === false && strpos( $word, strtolower($letter)) === false) {
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
        if (strpos($letters, $word[$i]) !== false || strpos(strtolower($letters), $word[$i]) !== false) {
          $result .= $word[$i];
        }
        // Blank
        else {
          $result .= '-';
        }
      }
      // Do we have any dashes?
      if (strpos($result, '-') === FALSE) {
        // Ding ding ding! You win!
        $stmt4 = $this->DB->prepare("UPDATE game SET won = 1, over = 1 WHERE game_id = ". $gameid);
        $stmt4->execute();
      }
    }
    // Return the word progress
    //return getWord($gameid);

  }
}

?>
