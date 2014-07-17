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
stockManager.controller('DriveOrdersStatisticsController', function ($scope, Restangular) {
	$scope.ordersCount = Restangular.one('drive/statistics/orders-count').get().$object;
	$scope.ordersRevenue = Restangular.one('drive/statistics/orders-revenue').get().$object;
	$scope.customersCount = Restangular.one('drive/statistics/customers-count').get().$object;
	$scope.deliveredPercent = Restangular.one('drive/statistics/delivered-percent').get().$object;
});