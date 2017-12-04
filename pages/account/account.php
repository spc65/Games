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
				<button type="button" class="btn btn-danger playBtn" onclick="window.location.href = '../../api/single_player.php';">Play now</button>
			</div>
		</div>
		<!-- <div class="privateGame accountBox">
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
		</div> -->
		<div class="existingGames accountBox">
			<div class="expand">
				<div class="centerText title">Existing Game</div>
				<hr>
				<br>
				<table class="table table-hover">
			    <thead>
			      <tr>
			        <th>Progress</th>
							<th>Mistakes</th>
			        <th>Challenger</th>
							<th></th>
			      </tr>
			    </thead>
			    <tbody>
			      <tr ng-repeat="x in existingGames">
			        <td>{{x.progress}}</td>
							<td>{{x.mistakes}}</td>
			        <td>{{x.challenger_id}}</td>
			        <!-- <td><button type="button" class="btn btn-danger btn-xs" ng-click="window.location.href = '../play/play.php?id={{x.game_id}}';">Play</button></td> -->
							<td>
								<a ng-if="x.over == 0" class="btn btn-primary btn-xs btn-block" href="../play/play.php?id={{x.game_id}}">Play</a>
								<span ng-if="x.over == 1 && x.won == 1" class="btn btn-success btn-xs">You won</span>
								<span ng-if="x.over == 1 && x.won == 0" class="btn btn-danger btn-xs">You lost</span>
							</td>
			      </tr>
			  </table>
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
