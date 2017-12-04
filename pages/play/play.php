<!DOCTYPE html>
<html>
<head>
<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
<link rel="stylesheet" type="text/css" href="play.css" />
<title>Hangman!</title>
</head>
<body ng-app="hangman" ng-controller="hangmanCtrl">
  <div id="game_id" style="display: none;"><?php
        $output = $_GET["id"];
        echo htmlspecialchars($output);
    ?></div>
  <div class="board">
    <div class="state box">
      Lives Left<br>
      {{lives}}
    </div>
    <div class="letters box">
        <button ng-repeat="letter in letters" class="letter" ng-click="guess(letter)"> {{letter}} </button>
    </div>
    <div class="words box">
      {{ word }}
    </div>
  </div>
<script type="text/javascript" src="play.js"></script>
</body>
</html>
