<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8">
<title>Ninja Creek</title>
<?php
	require("includes.php");
?>
<script src="scripts/sign-up-script.js"></script>
</head>
<body>

<?php
	require('header.php');
?>

<?php
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$username = $_POST["username"];
		$password1 = $_POST["password1"];
  		$password2 = $_POST["password2"];
		$email = $_POST["email"];
		if(ctype_alpha(str_replace(' ', '', $username)) === false){
			//name can only contain letters and spaces
			echo "name is invalid".$username;
			require('username-invalid.html');
		}else{
			if($password1 !== $password2){
				//passwords are not the same
				//record ip
				//require('error/passwords-dont-match.html');
				echo "passwords dont match";
			}else{
				if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
					//not a valid email
					echo "invalid email";
					require('email-invalid.html');
				}else{
					if(findUser($email)){
						//email already has account linked
						require('email-already-inuse.html');
					}else{
						//password hasing doen in insert new user
						echo "new user inserted";
						insertNewUser($username,$password1,$email);
					}
				}
			}
		}
	}else{
		require('sinu.html');
	}
	
	function findUser($email){
		$db = new mysqli('localhost','NCreekReader','IwillRead','ncFoods');
		if(mysqli_connect_errno()){
			echo '<p>Error: Could not connect to database.</p>';
			exit;
		}
		$query = "SELECT email FROM users WHERE email LIKE '".$email."'";
		$stmt = $db->prepare($query);
		$stmt->execute();
		$stmt->store_result();

		$stmt->bind_result($row);
		
		$result = $stmt->num_rows;
		$stmt->free_result();
		$db->close();
		return $result;
	}
	
	function insertNewUser($username, $password, $email){
		@$db = new mysqli('localhost','NCreekWriter','Iwi%%%ll000WRITE','ncFoods');
		if(mysqli_connect_errno()){
			echo "<p>Error: could not connect to database.</p>";
			exit;
		}

		$query = "SELECT * FROM users";
		$result = $db->query($query);
		//echo $result->num_rows;
		if($result->num_rows > 50){
			echo "<p>Database is full</p>";
		}else{
			$result->close();
			//hash the password
			$password = password_hash($password, PASSWORD_DEFAULT);
			
			$query = "INSERT INTO users(username,password,email) VALUES('".$username."','".$password."','".$email."')";
		
			$stmt = $db->prepare($query);
			//$stmt->bind_param();
		
			$stmt->execute();
	
			if($stmt->affected_rows > 0){
				echo "<p>User was successfully created!</p>";
			}else{
				echo "<p>An error has occured.<br/>The user could not be created.</p>";
			}
		}
	}
?>





<?php
	require('footer.php');
?>

</body>
</html>