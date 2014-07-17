stockManager.controller('OrdersAddController', function ($scope, $location, $q, Restangular) {
	$scope.newEntity = true;
	$scope.title = 'Ajout';

	$scope.order = {
		order_lines: []
	};

	Restangular.all('suppliers').getList().then(function(suppliers) {
		$scope.suppliers = suppliers;
	});

	Restangular.all('products').getList().then(function(products) {
		$scope.products = products;
	});

	$scope.save = function() {
		Restangular.all('orders').post($scope.order).then(function(order) {
			var promises = [];

			angular.forEach($scope.order.order_lines, function(line) {
				promises.push(order.post('lines', line));
			});

			$q.all(promises).then(function() {
				$location.path('/orders/list');
			});
		});
	};
});

stockManager.controller('OrdersEditController', function ($scope, $routeParams, $location, $q, Restangular) {
	$scope.title = 'Édition';

	$scope.reload = function() {
		Restangular.one('orders', $routeParams.id).get({ nesting : 1 }).then(function(order) {
			$scope.order = order;
		});

		Restangular.all('suppliers').getList().then(function(suppliers) {
			$scope.suppliers = suppliers;
		});

		Restangular.all('products').getList().then(function(products) {
			$scope.products = products;
		});
	};

	$scope.reload();

	$scope.save = function() {
		var ok = true,
			promises = [];

		if ($scope.order.validated) {
			ok = confirm('Attention ! Si vous validez une commande, celle-ci ne sera plus modifiable. Souhaitez-vous continuer ?');
		}

		if (ok) {
			$scope.order.put();

			angular.forEach($scope.order.order_lines, function(line) {
				if (typeof line.id == 'undefined') {
					promises.push($scope.order.post('lines', line));
				} else {
					promises.push(Restangular.one('orders/' + $scope.order.id + '/lines', line.id).customPUT(line, null));
				}
			});

			function saved() {
				if ($scope.order.validated) {
					$location.path('/orders/list');
				} else {
					$scope.reload();
				}
			}

			if (promises.length > 0) {
				$q.all(promises).then(saved);
			} else {
				saved();
			}
		}
	};
});

stockManager.controller('OrdersListController', function ($scope, $route, Restangular) {
	Restangular.all('orders').getList({ nesting: 1 }).then(function(orders) {
		$scope.orders = orders;
	});

	$scope.delete = function(id) {
		var index;

		angular.forEach($scope.orders, function(order, index) {
			if (order.id == id) {
				index = index;

				order.remove().then(function() {
					$route.reload();
				});
			}
		});

		$scope.orders.splice(index, 1);
	};
});

stockManager.controller('OrderLinesController', function ($scope, Restangular) {
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
		$scope.line = $parent.order.order_lines[$parent.order.order_lines.indexOf(line)];
	};

	$scope.save = function() {
		$scope.displayed = false;

		if ($scope.newEntity) {
			$parent.order.order_lines.push($scope.line);
		}
	};

	// Listen to the action events
	$scope.$on('orderLines:add', $scope.add);

	$scope.$on('orderLines:edit', function(event, line) {
		$scope.edit(line);
	});
});