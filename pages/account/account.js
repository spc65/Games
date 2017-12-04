var app = angular.module('account', []);

app.controller('accountCtrl', function($scope) {

  $scope.existingGames = [{"player":"You have no existing games"}];
  $scope.friends = [{"player":"You have not added any friends yet."}];

});
