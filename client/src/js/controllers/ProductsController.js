stockManager.controller('ProductsAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.product = {};

	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	$scope.save = function() {
		Restangular.all('products').post($scope.product, null, { suppliers : $scope.product.suppliers }).then(function() {
			$location.path('/products/list');
		});
	};
});

stockManager.controller('ProductsEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("products", $routeParams.id).get({ nesting : 1 }).then(function(product) {
		$scope.product = product;
	});
	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	$scope.save = function() {
		$scope.product.put({ suppliers : $scope.product.suppliers });
	};
});

stockManager.controller('ProductsListController', function ($scope, $route, Restangular) {
	Restangular.all('products').getList().then(function(products) {
		$scope.products = products;
	});

	$scope.delete = function(index) {
		$scope.products[index].remove().then(function() {
			$route.reload();
		});
		$scope.products.splice(index, 1);
	};
});