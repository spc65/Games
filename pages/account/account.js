var app = angular.module('account', []);

app.controller('accountCtrl', function($scope, $http,$interval) {

  $scope.existingGames = [{"player":"You have no existing games"}];
  $scope.friends = [{"player":"You have not added any friends yet."}];
  $scope.error = "";
  $scope.getFriends = function(){
    $http.get("../../api/get_friends.php").then(function(response) {
      // console.log(response.data.games);
      console.log(response.data);
      if(response.data.friends.length > 0){
        $scope.friends = response.data.friends;
      }
    });
  }
  $scope.getFriends();

  $http.get("../../api/existing_games.php").then(function(response) {
    // console.log(response.data.games);
    console.log(response);
    if(response.data.games.length > 0){
      $scope.existingGames = response.data.games;
    }
  });

  $interval(function() {


  $http.get("../../api/existing_games.php").then(function(response) {
    // console.log(response.data.games);
    console.log(response);
    if(response.data.games.length > 0){
      $scope.existingGames = response.data.games;
    }
  });

}, 5000);
  $scope.friendsName = "";
  $scope.addFriend = function(){
    if($scope.friendsName != ""){
      console.log($scope.friendsName);
      $http.get("../../api/add_friend.php?fname="+$scope.friendsName).then(function(response) {
        console.log(response.data);
        if(response.data == "username does not exist"){
          $scope.error = response.data;
        }else{
          $scope.error = "";
        }
        $scope.getFriends();
      });
    }

  }
  $scope.send = function(player){
    console.log(player.player);
    console.log(player.wordTo);
    $http.get("../../api/friend_game.php?fname="+player.player+"&word="+player.wordTo).then(function(response) {
      console.log(response.data);
      player.wordTo = "";
    });
  }

});
