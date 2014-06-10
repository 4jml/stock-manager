stockManager.controller('ShopsAddController', function ($scope, Restangular) {
	$scope.title = 'Ajout';

	$scope.shop = {};

	$scope.save = function() {
		Restangular.all('shops').post($scope.shop);
		$location.path('/shopping/products/list');
	};
});

stockManager.controller('ShopsEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("shops", $routeParams.id).get().then(function(shop) {
		$scope.shop = shop;
	});

	$scope.save = function() {
		$scope.shop.put();
	};
});

stockManager.controller('ShopsListController', function ($scope, Restangular) {
	$scope.shopsAPI = Restangular.all('shops');

	$scope.shopsAPI.getList().then(function(shops) {
		$scope.shops = shops;
	});
});