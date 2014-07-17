stockManager.controller('ProductsAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.product = {};

	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});
	Restangular.all('sections').getList({ nesting : 1}).then(function(sections) {
		$scope.sections = sections;
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
		angular.forEach(product.suppliers, function(value, key) {
			product.suppliers[key] = value.id;
		});
		$scope.product = product;
	});
	Restangular.one("products", $routeParams.id).getList('stocks').then(function(shops) {
		$scope.shops = shops;
	});
	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});
	Restangular.all('sections').getList({ nesting : 1}).then(function(sections) {
		$scope.sections = sections;
	});

	$scope.save = function() {
		$scope.product.put();
		Restangular.one('products', $scope.product.id).all('suppliers').post($scope.product.suppliers);
		var data = new FormData();
		data.append('image', $('input[name="image"]')[0].files[0]);
		Restangular.one('products', $scope.product.id)
		.all('image')
		.withHttpConfig({transformRequest: angular.identity})
		.customPOST(data, undefined, {}, {'Content-Type': undefined});
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