<?php
//
// Steven Cleary
//
class DataBaseAdaptor {
  private $db;

  public function __construct(){
    $db = 'mysql:dbname=quotes; charset=utf8; host=127.0.0.1';
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

  public function getQuotesAsArray() {
    $stmt = $this->DB->prepare( "SELECT * FROM quotations WHERE flagged LIKE '0' ORDER BY rating DESC;");
    $stmt->execute();
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
  }
  public function upVote($id){
    $stmt = $this->DB->prepare("UPDATE quotations SET rating = rating + 1 WHERE id = ".$id.";");
    $stmt->execute();
  }
  public function downVote($id){
    $stmt = $this->DB->prepare( "UPDATE quotations SET rating = rating - 1 WHERE id = ".$id.";");
    $stmt->execute();
    return $stmt->fetchAll( PDO::FETCH_ASSOC );
  }
  public function flag($id){
    $stmt = $this->DB->prepare( "UPDATE quotations SET flagged = 1 WHERE id = ".$id.";");
    $stmt->execute();
  }
  public function register($username, $password){
    $stmt = $this->DB->prepare( "SELECT * FROM users WHERE username='".$username."';");
    $stmt->execute();
    $users = $stmt->fetchAll( PDO::FETCH_ASSOC );
    if(count($users) > 0){
      return "uae";
    }
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
    //$hash = password_hash($password, PASSWORD_DEFAULT);
    if(password_verify($password,$users[0]["hash"])){
      return $users[0]["username"];
    }else{
      return "incorrect password";
    }
  }
  public function newQuote($quote,$author){
    $stmt = $this->DB->prepare("INSERT INTO quotations(added,quote,author,rating,flagged) VALUES(NOW(),'".$quote."','".$author."',0,0);");
    $stmt->execute();
  }
  public function unflagAll(){
    $stmt = $this->DB->prepare( "UPDATE quotations SET flagged = 0;");
    $stmt->execute();
    return "gh";
  }
}

?>
