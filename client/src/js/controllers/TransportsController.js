stockManager.controller('TransportsAddController', function ($scope, $location, $q, Restangular) {
	$scope.newEntity = true;
	$scope.title = 'Ajout';

	$scope.transport = {
		transport_lines: []
	};

	Restangular.all('drivers').getList().then(function(drivers) {
		$scope.drivers = drivers;
	});

	Restangular.all('vehicules').getList().then(function(vehicules) {
		$scope.vehicules = vehicules;
	});

	Restangular.all('shops').getList().then(function(shops) {
		$scope.shops = shops;
	});

	Restangular.all('products').getList().then(function(products) {
		$scope.products = products;
	});

	$scope.save = function() {
		Restangular.all('transports').post($scope.transport).then(function(transport) {
			var promises = [];

			angular.forEach($scope.transport.transport_lines, function(line) {
				promises.push(transport.post('lines', line));
			});

			$q.all(promises).then(function() {
				$location.path('/transports/list');
			});
		});
	};
});

stockManager.controller('TransportsEditController', function ($scope, $routeParams, $location, $q, Restangular) {
	$scope.title = 'Édition';

	$scope.reload = function() {
		Restangular.one('transports', $routeParams.id).get({ nesting : 1 }).then(function(transport) {
			$scope.transport = transport;
		});

		Restangular.all('drivers').getList().then(function(drivers) {
			$scope.drivers = drivers;
		});

		Restangular.all('vehicules').getList().then(function(vehicules) {
			$scope.vehicules = vehicules;
		});

		Restangular.all('shops').getList().then(function(shops) {
			$scope.shops = shops;
		});

		Restangular.all('products').getList().then(function(products) {
			$scope.products = products;
		});
	};

	$scope.reload();

	$scope.save = function() {
		var ok = true,
			promises = [];

		if ($scope.transport.validated) {
			ok = confirm('Attention ! Si vous validez un transport, celui-ci ne sera plus modifiable. Souhaitez-vous continuer ?');
		}

		if (ok) {
			angular.forEach($scope.transport.transport_lines, function(line) {
				if (typeof line.id == 'undefined') {
					promises.push($scope.transport.post('lines', line));
				} else {
					promises.push(Restangular.one('transports/' + $scope.transport.id + '/lines', line.id).customPUT(line, null));
				}
			});

			function linesSaved() {
				$scope.transport.put().then(function() {
					if ($scope.transport.validated) {
						$location.path('/transports/list');
					} else {
						$scope.reload();
					}
				});
			}

			if (promises.length > 0) {
				$q.all(promises).then(linesSaved);
			} else {
				linesSaved();
			}
		}
	};
});

stockManager.controller('TransportsListController', function ($scope, $route, Restangular) {
	Restangular.all('transports').getList({ nesting: 1 }).then(function(transports) {
		$scope.transports = transports;
	});

	$scope.delete = function(id) {
		var index;

		angular.forEach($scope.transports, function(transport, index) {
			if (transport.id == id) {
				index = index;

				transport.remove().then(function() {
					$route.reload();
				});
			}
		});

		$scope.transports.splice(index, 1);
	};
});

stockManager.controller('TransportLinesController', function ($scope, Restangular) {
	var $parent = $scope.$parent;

	$scope.add = function() {
		$scope.displayed = true;
		$scope.newEntity = true;
		$scope.title = 'Ajout';
		$scope.line = {};
	};

	$scope.edit = function(line) {
		$scope.displayed = true;
		$scope.newEntity = false;
		$scope.title = 'Édition';
		$scope.line = $parent.transport.transport_lines[$parent.transport.transport_lines.indexOf(line)];
	};

	$scope.save = function() {
		$scope.displayed = false;

		if ($scope.newEntity) {
			$parent.transport.transport_lines.push($scope.line);
		}
	};

	// Listen to the action events
	$scope.$on('transportLines:add', $scope.add);

	$scope.$on('transportLines:edit', function(event, line) {
		$scope.edit(line);
	});
});