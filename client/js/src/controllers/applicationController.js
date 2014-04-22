stockManager.controller('applicationController', function ($scope, AUTH_EVENTS, USER_ROLES, authService, sessionService) {
	$scope.currentUser = null;
	$scope.userRoles = USER_ROLES;
	$scope.isAuthorized = authService.isAuthorized;

	$scope.$on(AUTH_EVENTS.loginSuccess, function(event, data){
		$scope.currentUser = sessionService;
	});
});