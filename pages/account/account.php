<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="account.css" />

<title>Hangman!</title>
<?php
	require("../../includes.php");
?>
</head>
<body ng-app="account" ng-controller="accountCtrl">

  <?php
  	require('../header/header.php');
  ?>
	<div class="accountGrid">
		<div class="playNow accountBox center">
			<div class="expand">
				<button type="button" class="btn btn-danger playBtn">Play now</button>
			</div>
		</div>
		<div class="privateGame accountBox">
			<div class="expand">
				<div class="centerText title">Private Game</div>
				<hr>
				<br>
				Join existing game<br>
				<div class="form-group">
				  <label for="usr">Game ID:</label>
				  <input type="text" class="form-control" id="usr">
				</div>
				<br>
				<hr>
				<br>
				Start a private game<br><br>
				<button type="button" class="btn btn-success btn-block">create game</button>
			</div>
		</div>
		<div class="existingGames accountBox">
			<div class="expand">
				<div class="centerText title">Existing Game</div>
				<hr>
				<br>
				<div class="list-group">
  				<a ng-repeat="x in existingGames" href="#" class="list-group-item">{{x.player}}</a>
				</div>
			</div>
		</div>
		<div class="friendsList accountBox">
			<div class="expand">
				<div class="centerText title">Friends List</div>
				<hr>
				<br>
				<div class="list-group">
					<a ng-repeat="x in friends" href="#" class="list-group-item">{{x.player}}</a>
				</div>
			</div>
		</div>
	</div>



<script type="text/javascript" src="account.js"></script>
</body>
</html>
