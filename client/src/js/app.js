var stockManager = angular.module('stockManager' , [ 'ngRoute' ]);

stockManager.run(function(AuthService, SessionService) {
	AuthService.login(null);
});