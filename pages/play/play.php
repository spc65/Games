<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<link rel="stylesheet" type="text/css" href="play.css" />
<title>Hangman!</title>
<?php
	require("../../includes.php");
?>
</head>
<body ng-app="hangman" ng-controller="hangmanCtrl">
  <?php
    require('../header/header.php');
  ?>
  <div id="game_id" style="display: none;"><?php
        $output = $_GET["id"];
        echo htmlspecialchars($output);
    ?></div>
  <div class="board">
    <div class="state box">
      <div class="center">
        <div class="lives">
          <div ng-if="lives > 0">
            Lives Left<br>
            {{lives}}
          </div>
          <div ng-if="lives == 0 && won == 1">
            Game over<br>
            You won!
          </div>
          <div ng-if="lives == 0 && won == 0">
            Game Over<br>
            You Lost!
          </div>
        </div>
      </div>
    </div>
    <div class="letters box">
        <button ng-repeat="letter in letters" class="letter" ng-click="guess(letter)"> {{letter}} </button>
    </div>
    <div class="used_letters box">
      <button ng-if="word.toLowerCase().indexOf(letter.toLowerCase()) > -1" ng-repeat="letter in used_letters" class="letter correct">{{letter}}</button>      
      <button ng-if="word.toLowerCase().indexOf(letter.toLowerCase()) == -1" ng-repeat="letter in used_letters" class="letter incorrect">{{letter}}</button>
    </div>
    <div class="words box">
      <div class="center">
        <div class="word">
          {{ word }}
        </span>
      </span>
    </div>
  </div>
<script type="text/javascript" src="play.js"></script>
</body>
</html>
