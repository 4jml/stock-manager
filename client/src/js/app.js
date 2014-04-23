var stockManager = angular.module('stockManager' , [ 'ngRoute' ]);

stockManager.run(function($rootScope, AuthService, SessionService) {
	AuthService.login(null);
});