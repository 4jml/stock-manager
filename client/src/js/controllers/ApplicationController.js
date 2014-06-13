stockManager.controller('ApplicationController', function ($rootScope, $scope, $timeout, $route, $location, AUTH_EVENTS, USER_ROLES, AuthService, SessionService) {
	$scope.app = { user : SessionService };
	$scope.isAuthorized = AuthService.isAuthorized;
	$scope.isAuthenticated = AuthService.isAuthenticated;
	$scope.isLoaded = false;

	$scope.$on(AUTH_EVENTS.loginAttempt, function(event, data){
		$timeout(function() {
			$scope.isLoaded = true;
		}, 500);
	});

	$rootScope.$on("$routeChangeSuccess", function(currentRoute, previousRoute){
		$scope.app.routeTitle = $route.current.routeTitle;
		$scope.app.routeName = $route.current.routeName;
	});

	$scope.search = function() {
		$location.path('/search/' + $scope.searchQuery);
	};
});