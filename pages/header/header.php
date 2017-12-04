<?php
    ini_set('session.use_strict_mode', 1);
    session_start();
?>

    <div class="myHeader">


    	<?php
    		if(isset($_SESSION['username'])){
    			echo '
        <div class="title navBtn"><span><a href="../account/account.php">Hangman</a></span></div>
        <div class="signuph navBtn"><a href="../account/account.php"><span style="display:inline;" class="glyphicon glyphicon-user"></span>   Welcome   '.$_SESSION['username'].'</a></div>
        <div class="loginh navBtn"><a href="../../api/logout.php"><span style="display:inline;" class="glyphicon glyphicon-log-in"></span> Logout</a></div>
    					';
    		}else{
    			echo '
        <div class="title navBtn"><span><a href="../home/index.php">Hangman</a></span></div>
        <div class="signuph navBtn"><a href="../signup/signup.php"><span style="display:inline;" class="glyphicon glyphicon-user"></span> Sign Up</a></div>
        <div class="loginh navBtn"><a href="../login/login.php"><span style="display:inline;" class="glyphicon glyphicon-log-in"></span> Login</a></div>
    					';
    		}
	    ?>

    </div>
