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
			when('/central', {
				templateUrl: 'views/central/index.html',
				controller: 'CentralIndexController',
				routeTitle: 'Centrale d\'achat',
				routeName: 'central'
			}).
			when('/suppliers/add', {
				templateUrl: 'views/suppliers/edit.html',
				controller: 'SuppliersAddController',
				routeTitle: 'Ajout | Fournisseurs',
				routeName: 'suppliers_add'
			}).
			when('/suppliers/edit/:id', {
				templateUrl: 'views/suppliers/edit.html',
				controller: 'SuppliersEditController',
				routeTitle: 'Édition | Fournisseurs',
				routeName: 'suppliers_edit'
			}).
			when('/suppliers/list', {
				templateUrl: 'views/suppliers/list.html',
				controller: 'SuppliersListController',
				routeTitle: 'Liste | Fournisseurs',
				routeName: 'suppliers_list'
			}).
			when('/orders/add', {
				templateUrl: 'views/orders/edit.html',
				controller: 'OrdersAddController',
				routeTitle: 'Ajout | Commandes | Fournisseurs',
				routeName: 'orders_add'
			}).
			when('/orders/edit/:id', {
				templateUrl: 'views/orders/edit.html',
				controller: 'OrdersEditController',
				routeTitle: 'Édition | Commandes | Fournisseurs',
				routeName: 'orders_edit'
			}).
			when('/orders/list', {
				templateUrl: 'views/orders/list.html',
				controller: 'OrdersListController',
				routeTitle: 'Liste | Commandes | Fournisseurs',
				routeName: 'orders_list'
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
			when('/sections/add', {
				templateUrl: 'views/sections/edit.html',
				controller: 'SectionsAddController',
				routeTitle: 'Ajout | Sections',
				routeName: 'sections_add'
			}).
			when('/sections/edit/:id', {
				templateUrl: 'views/sections/edit.html',
				controller: 'SectionsEditController',
				routeTitle: 'Édition | Sections',
				routeName: 'sections_edit'
			}).
			when('/sections/list', {
				templateUrl: 'views/sections/list.html',
				controller: 'SectionsListController',
				routeTitle: 'Liste | Sections',
				routeName: 'sections_list'
			}).
			when('/categories/add', {
				templateUrl: 'views/categories/edit.html',
				controller: 'CategoriesAddController',
				routeTitle: 'Ajout | Catégories',
				routeName: 'categories_add'
			}).
			when('/categories/edit/:id', {
				templateUrl: 'views/categories/edit.html',
				controller: 'CategoriesEditController',
				routeTitle: 'Édition | Catégories',
				routeName: 'categories_edit'
			}).
			when('/categories/list', {
				templateUrl: 'views/categories/list.html',
				controller: 'CategoriesListController',
				routeTitle: 'Liste | Catégories',
				routeName: 'categories_list'
			}).
			when('/transports/add', {
				templateUrl: 'views/transports/edit.html',
				controller: 'TransportsAddController',
				routeTitle: 'Ajout | Transports',
				routeName: 'transports_add'
			}).
			when('/transports/edit/:id', {
				templateUrl: 'views/transports/edit.html',
				controller: 'TransportsEditController',
				routeTitle: 'Édition | Transports',
				routeName: 'transports_edit'
			}).
			when('/transports/list', {
				templateUrl: 'views/transports/list.html',
				controller: 'TransportsListController',
				routeTitle: 'Liste | Transports',
				routeName: 'transports_list'
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
			when('/drive/orders/add', {
				templateUrl: 'views/drive/orders/edit.html',
				controller: 'DriveOrdersAddController',
				routeTitle: 'Ajout | Commandes | radian-drive.fr',
				routeName: 'drive/orders_add'
			}).
			when('/drive/orders/edit/:id', {
				templateUrl: 'views/drive/orders/edit.html',
				controller: 'DriveOrdersEditController',
				routeTitle: 'Édition | Commandes | radian-drive.fr',
				routeName: 'drive/orders_edit'
			}).
			when('/drive/orders/list', {
				templateUrl: 'views/drive/orders/list.html',
				controller: 'DriveOrdersListController',
				routeTitle: 'Liste | Commandes | radian-drive.fr',
				routeName: 'drive/orders_list'
			}).
			when('/drive/orders/statistics', {
				templateUrl: 'views/drive/orders/statistics.html',
				controller: 'DriveOrdersStatisticsController',
				routeTitle: 'Statistiques | Commandes | radian-drive.fr',
				routeName: 'drive/orders_statistics'
			}).
			when('/drive/orders/:id', {
				templateUrl: 'views/drive/orders/view.html',
				controller: 'DriveOrdersViewController',
				routeTitle: 'Détails | Commandes | radian-drive.fr',
				routeName: 'drive/orders_view'
			}).
			otherwise({
				redirectTo: '/'
			});
	}
]);