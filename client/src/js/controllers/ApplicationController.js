stockManager.controller('ApplicationController', function ($scope, AUTH_EVENTS, USER_ROLES, AuthService, SessionService) {
	$scope.app = { user : SessionService };
	$scope.isAuthorized = AuthService.isAuthorized;
	$scope.isAuthenticated = AuthService.isAuthenticated;
});