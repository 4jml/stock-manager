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
			when('/search/:query', {
				templateUrl: 'views/misc/search.html',
				controller: 'SearchController',
				routeTitle: 'Recherche',
				routeName: 'search'
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
			when('/products/add', {
				templateUrl: 'views/products/edit.html',
				controller: 'ProductsAddController',
				routeTitle: 'Ajout | Produits',
				routeName: 'products_add'
			}).
			when('/products/edit/:id', {
				templateUrl: 'views/products/edit.html',
				controller: 'ProductsEditController',
				routeTitle: 'Édition | Produits',
				routeName: 'products_edit'
			}).
			when('/products/list', {
				templateUrl: 'views/products/list.html',
				controller: 'ProductsListController',
				routeTitle: 'Liste | Produits',
				routeName: 'products_list'
			}).
			when('/drivers/add', {
				templateUrl: 'views/drivers/edit.html',
				controller: 'DriversAddController',
				routeTitle: 'Ajout | Conducteurs',
				routeName: 'drivers_add'
			}).
			when('/drivers/edit/:id', {
				templateUrl: 'views/drivers/edit.html',
				controller: 'DriversEditController',
				routeTitle: 'Édition | Conducteurs',
				routeName: 'drivers_edit'
			}).
			when('/drivers/list', {
				templateUrl: 'views/drivers/list.html',
				controller: 'DriversListController',
				routeTitle: 'Liste | Conducteurs',
				routeName: 'drivers_list'
			}).
			when('/vehicules/add', {
				templateUrl: 'views/vehicules/edit.html',
				controller: 'VehiculesAddController',
				routeTitle: 'Ajout | Véhicules',
				routeName: 'vehicules_add'
			}).
			when('/vehicules/edit/:id', {
				templateUrl: 'views/vehicules/edit.html',
				controller: 'VehiculesEditController',
				routeTitle: 'Édition | Véhicules',
				routeName: 'vehicules_edit'
			}).
			when('/vehicules/list', {
				templateUrl: 'views/vehicules/list.html',
				controller: 'VehiculesListController',
				routeTitle: 'Liste | Véhicules',
				routeName: 'vehicules_list'
			}).
			otherwise({
				redirectTo: '/'
			});
	}
]);