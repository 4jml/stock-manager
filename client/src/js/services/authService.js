stockManager.factory('authService', function ($http, sessionService) {
	return {
		login: function (credentials) {
			return $http
			.post('/login', credentials)
			.then(function (res) {
				sessionService.create(res.id, res.userid, res.role);
			});
		},
		isAuthenticated: function () {
			return !!sessionService.userId;
		},
		isAuthorized: function (authorizedRoles) {
			if (!angular.isArray(authorizedRoles)) {
				authorizedRoles = [authorizedRoles];
			}
			return (this.isAuthenticated() &&
				authorizedRoles.indexOf(sessionService.userRole) !== -1);
		}
	};
});