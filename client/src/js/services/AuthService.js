stockManager.factory('AuthService', function ($rootScope, $http, SessionService, AUTH_EVENTS) {
	return {
		login: function (credentials) {
			return $http
			.post('auth', credentials)
			.then(
				function (res) {
					SessionService.create(res.data.id, res.data.username, res.data.role);
					$rootScope.$broadcast(AUTH_EVENTS.loginAttempt);
				},
				function (res) {
					SessionService.create(null, null, null);
					$rootScope.$broadcast(AUTH_EVENTS.loginAttempt);
				}
			);

			$rootScope.$broadcast(AUTH_EVENTS.loginSuccess);
		},
		isAuthenticated: function () {
			return !!SessionService.id;
		},
		isAuthorized: function (authorizedRoles) {
			if (!angular.isArray(authorizedRoles)) {
				authorizedRoles = [authorizedRoles];
			}
			return (this.isAuthenticated() &&
				authorizedRoles.indexOf(SessionService.role) !== -1);
		}
	};
});