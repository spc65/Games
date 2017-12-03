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
	public function createGame($ch_id, $a_id, $word) {

		$stmt = $this->DB->prepare("INSERT INTO game (challenger_id,
									acceptor_id, word, num_mistakes, over, won)
									VALUES (" . $ch_id . ', ' . $a_id . ', ' . $word, . ', 0, FALSE, 0);');
		$stmt->execute();
		//return $stmt->fetchAll(PDO::FETCH_ASSOC);	<-----DON'T NEED TO RETURN ANYTHING------
	}

	// Returns the word progress in the given game.
	public function getWord($gameId) {

		// Format our query and execute it
		$stmt = $this->DB->prepare("SELECT word, letters_used FROM game WHERE game_id = " . $gameId . ';');
		$stmt->execute();

		// Get the word and the letters used so far
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$word = $results['word'];
		$letters = $results['letters_used'];
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

		// Return the word progress
		return $result;
	}

	// Returns the number of lives the player has given
	// the game id provided by the client.
	public function getLives($gameid) {

		// Query the db
		$stmt = $this->DB->prepare("SELECT num_mistakes FROM game WHERE game_id = " . $gameid);
		$stmt->execute();

		// Grab the results of the query
		$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

		// Return the number of lives the player has left
		return 6 - $results['num_mistakes'];
	}

	// Adds the desired letter to the game's
	// list of used letters and updates the
	// number of mistakes made in the game,
	// and determines if the game was won, lost,
	// or is continuing.
	public function guess($gameid, $letter) {

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
}

// Here is our database
$theDBA = new DatabaseAdaptor();






































?>
