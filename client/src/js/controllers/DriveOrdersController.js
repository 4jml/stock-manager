stockManager.controller('DriveOrdersListController', function ($scope, $route, Restangular) {
	Restangular.all('drive/orders').getList({ nesting : 1 }).then(function(orders) {
		$scope.orders = orders;
	});
});
stockManager.controller('DriveOrdersViewController', function ($scope, $routeParams, Restangular) {
	Restangular.one('drive/orders', $routeParams.id).get({ nesting : 1 }).then(function(order) {
		$scope.order = order;
	});
});