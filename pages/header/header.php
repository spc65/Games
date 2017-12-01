<?php
    ini_set('session.use_strict_mode', 1);
    session_start();
?>

    <div class="myHeader">

        <div class="title navBtn">
          <span><a href="../home/index.php">Hangman</a></span>
        </div>
    	<?php
    		if(isset($_SESSION['username'])){

    			echo '
        <div class="signuph navBtn"><a href="account.php"><span style="display:inline;" class="glyphicon glyphicon-user"></span>   Welcome   '.$_SESSION['username'].'</a></div>
        <div class="loginh navBtn"><a href="logout.php"><span style="display:inline;" class="glyphicon glyphicon-log-in"></span> Logout</a></div>
    					';
    		}else{
    			echo '
        <div class="signuph navBtn"><a href="../signup/signup.php"><span style="display:inline;" class="glyphicon glyphicon-user"></span> Sign Up</a></div>
        <div class="loginh navBtn"><a href="../login/login.php"><span style="display:inline;" class="glyphicon glyphicon-log-in"></span> Login</a></div>
    					';
    		}
	    ?>

    </div>
