<?php
class DatabaseAdaptor {

	private $DB;

	public function __construct() {

		$database = 'mysql:dbname=hangman; charset=utf8; host=127.0.0.1';
		$user = 'root';
		$password = '';

		try {

			$this->DB =  new PDO($database, $user, $password);
			$this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {

			echo ('Error establishing connection');
			exit();
		}
	}

	// Adds a game into the table of games


// Here is our database
$theDBA = new DatabaseAdaptor();


?>
