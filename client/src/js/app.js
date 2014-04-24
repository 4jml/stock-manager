var stockManager = angular.module('stockManager' , [ 'ngRoute', 'restangular' ]);

stockManager.run(function($rootScope, AuthService, SessionService) {
	AuthService.login(null);
});