stockManager.controller('SearchController', function ($scope, $routeParams, Restangular) {
	$scope.query = $routeParams.query;

	Restangular.all('shops/search/' + $scope.query).getList().then(function(shops) {
		$scope.shops = shops;
	});
	Restangular.all('products/search/' + $scope.query).getList().then(function(products) {
		$scope.products = products;
	});
	Restangular.all('drivers/search/' + $scope.query).getList().then(function(drivers) {
		$scope.drivers = drivers;
	});
});
