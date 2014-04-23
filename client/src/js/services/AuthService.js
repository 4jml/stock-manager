stockManager.factory('AuthService', function ($http, SessionService) {
	return {
		login: function (credentials) {
			return $http
			.post('auth', credentials)
			.then(function (res) {
				SessionService.create(res.data.id, res.data.username, res.data.role);
			});
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