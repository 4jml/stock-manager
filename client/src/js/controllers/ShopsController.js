stockManager.controller('ShopsAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.shop = {};

	$scope.save = function() {
		Restangular.all('shops').post($scope.shop).then(function() {
			$location.path('/shops/list');
		});
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
	$scope.delete = function(product) {
		product.remove();
	};
});

stockManager.controller('ShopsListController', function ($scope, $route, Restangular) {
	$scope.shopsAPI = Restangular.all('shops');

	$scope.shopsAPI.getList().then(function(shops) {
		$scope.shops = shops;
	});

	$scope.delete = function(index) {
		$scope.shops[index].remove().then(function() {
			$route.reload();
		});
		$scope.shops.splice(index, 1);
	};
});