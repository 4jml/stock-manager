stockManager.controller('loginController', function ($scope, $rootScope, AUTH_EVENTS, authService) {
	$scope.credentials = {
		username: '',
		password: ''
	};
	$scope.login = function (credentials) {
		authService.login(credentials).then(function () {
			$rootScope.$broadcast(AUTH_EVENTS.loginSuccess);
		}, function () {
			$rootScope.$broadcast(AUTH_EVENTS.loginFailed);
		});
	};
});