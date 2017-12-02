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

  public function register($username, $password, $email){
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

}

?>
