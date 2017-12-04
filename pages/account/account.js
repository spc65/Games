var app = angular.module('account', []);

app.controller('accountCtrl', function($scope, $http) {

  $scope.existingGames = [{"player":"You have no existing games"}];
  $scope.friends = [{"player":"You have not added any friends yet."}];
  $http.get("../../api/existing_games.php").then(function(response) {
    console.log(response.data.games);
    if(response.data.games.length > 0){
      $scope.existingGames = response.data.games;
    }
    });

});
