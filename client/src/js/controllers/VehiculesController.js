stockManager.controller('VehiculesAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.vehicule = {};

	$scope.save = function() {
		Restangular.all('vehicules').post($scope.vehicule).then(function() {
			$location.path('/vehicules/list');
		});
	};
});

stockManager.controller('VehiculesEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("vehicules", $routeParams.id).get({ nesting : 1 }).then(function(vehicule) {
		$scope.vehicule = vehicule;
	});

	$scope.save = function() {
		$scope.vehicule.put();
	};
});

stockManager.controller('VehiculesListController', function ($scope, $route, Restangular) {
	Restangular.all('vehicules').getList().then(function(vehicules) {
		$scope.vehicules = vehicules;
	});

	$scope.delete = function(index) {
		$scope.vehicules[index].remove().then(function() {
			$route.reload();
		});
		$scope.vehicules.splice(index, 1);
	};
});