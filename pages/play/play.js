var app = angular.module('hangman', []);
var id = document.getElementById("game_id").innerHTML;
app.controller('hangmanCtrl', function($scope,$http) {
  $scope.gameid = id;
  $scope.word = "";
  $scope.lives = 0;
  $scope.letters = ['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
  $http.get("../../api/game_update.php?id="+$scope.gameid).then(function(response) {
    $scope.word = response.data.word;
    $scope.lives = response.data.lives;
  });
  $scope.guess = function(letter){
    //console.log(letter);
    $scope.letters.splice($scope.letters.indexOf(letter),1);
    $http.get("../../api/guess.php?id="+$scope.gameid+"&letter="+letter).then(function(response) {
      console.log(response.data);
      $scope.word = response.data.word;
      $scope.lives = response.data.lives;
    });
  }
});
