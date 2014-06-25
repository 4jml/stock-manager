stockManager.controller('DriversAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.driver = {};

	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	$scope.save = function() {
		Restangular.all('drivers').post($scope.driver).then(function() {
			$location.path('/drivers/list');
		});
	};
});

stockManager.controller('DriversEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("drivers", $routeParams.id).get({ nesting : 1 }).then(function(driver) {
		$scope.driver = driver;
	});
	Restangular.all("suppliers").getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	$scope.save = function() {
		$scope.driver.put();
	};
});

stockManager.controller('DriversListController', function ($scope, $route, Restangular) {
	Restangular.all('drivers').getList().then(function(drivers) {
		$scope.drivers = drivers;
	});

	$scope.delete = function(index) {
		$scope.drivers[index].remove().then(function() {
			$route.reload();
		});
		$scope.drivers.splice(index, 1);
	};
});