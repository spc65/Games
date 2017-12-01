
	var app = angular.module('signup', []);

	app.controller('signupctrl', function($scope,$window,$document,$http) {

		$scope.usernameclass = "form-group";
		$scope.emailclass = "form-group";
		$scope.password1class = "form-group";
		$scope.password2class = "form-group";
		$scope.passwordsDontMatch = false;
		$scope.invalidEmail = false;

		$scope.username = "";
		$scope.email = "";
		$scope.password1 = "";
		$scope.password2 = "";

		$scope.attempt = function($form){
			if($scope.password1 !== $scope.password2){
				$scope.password1class = "form-group has-error";
				$scope.password2class = "form-group has-error";
				$scope.passwordsDontMatch = true;
				return;
			}else{
				$scope.password1class = "form-group";
				$scope.password2class = "form-group";
				$scope.passwordsDontMatch = false;
			}
			if(!angular.isDefined($scope.email)){
				$scope.emailclass = "form-group has-error";
				$scope.invalidEmail = true;
				return;
			}else{
				$scope.emailclass = "form-group";
				$scope.invalidEmail = false;
			}
			$form.commit();

		}

		$scope.newuser = function () {

		}

	});

	app.directive("ngFormCommit", [function(){
    return {
        require:"form",
        link: function($scope, $el, $attr, $form) {
            $form.commit = function() {
                $el[0].submit();
            };
        }
    };
	}]);
