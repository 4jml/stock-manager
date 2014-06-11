stockManager.controller('ProductsAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.product = {};

	$scope.save = function() {
		Restangular.all('products').post($scope.product).then(function() {
			$location.path('/products/list');
		});
	};
});

stockManager.controller('ProductsEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("products", $routeParams.id).get().then(function(product) {
		$scope.product = product;
	});

	$scope.save = function() {
		$scope.product.put();
	};
});

stockManager.controller('ProductsListController', function ($scope, $route, Restangular) {
	$scope.productsAPI = Restangular.all('products');

	$scope.productsAPI.getList().then(function(products) {
		$scope.products = products;
	});

	$scope.delete = function(index) {
		$scope.products[index].remove().then(function() {
			$route.reload();
		});
		$scope.products.splice(index, 1);
	};
});