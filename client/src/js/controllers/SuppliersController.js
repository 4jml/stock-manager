stockManager.controller('SuppliersAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.supplier = {};

	$scope.save = function() {
		Restangular.all('suppliers').post($scope.supplier).then(function() {
			$location.path('/suppliers/list');
		});
	};
});

stockManager.controller('SuppliersEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("suppliers", $routeParams.id).get().then(function(supplier) {
		$scope.supplier = supplier;
	});

	$scope.save = function() {
		$scope.supplier.put();
	};
});

stockManager.controller('SuppliersListController', function ($scope, $route, Restangular) {
	$scope.suppliersAPI = Restangular.all('suppliers');

	$scope.suppliersAPI.getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	$scope.delete = function(index) {
		$scope.suppliers[index].remove().then(function() {
			$route.reload();
		});
		$scope.suppliers.splice(index, 1);
	};
});