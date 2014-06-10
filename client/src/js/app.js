var stockManager = angular.module('stockManager' , [ 'ngRoute', 'restangular' ]);

stockManager.run(function($rootScope, AuthService, SessionService) {
	AuthService.login(null);
});

stockManager.config(['$routeProvider',
	function($routeProvider) {
		$routeProvider.
			when('/', {
				templateUrl: 'views/dashboard/dashboard.html',
				controller: 'DashboardController',
				routeTitle: 'Dashboard',
				routeName: 'dashboard'
			}).
			when('/shops/add', {
				templateUrl: 'views/shops/edit.html',
				controller: 'ShopsAddController',
				routeTitle: 'Ajout | Magasins',
				routeName: 'shops_add'
			}).
			when('/shops/edit/:id', {
				templateUrl: 'views/shops/edit.html',
				controller: 'ShopsEditController',
				routeTitle: 'Édition | Magasins',
				routeName: 'shops_edit'
			}).
			when('/shops/list', {
				templateUrl: 'views/shops/list.html',
				controller: 'ShopsListController',
				routeTitle: 'Liste | Magasins',
				routeName: 'shops_list'
			}).
			otherwise({
				redirectTo: '/'
			});
	}
]);