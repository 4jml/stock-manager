stockManager.controller('ApplicationController', function ($scope, $timeout, AUTH_EVENTS, USER_ROLES, AuthService, SessionService) {
	$scope.app = { user : SessionService };
	$scope.isAuthorized = AuthService.isAuthorized;
	$scope.isAuthenticated = AuthService.isAuthenticated;
	$scope.isLoaded = false;

	$scope.$on(AUTH_EVENTS.loginAttempt, function(event, data){
		$timeout(function() {
			$scope.isLoaded = true;
		}, 500);
	});
});