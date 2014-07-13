stockManager.controller('DriveOrdersListController', function ($scope, $route, Restangular) {
	Restangular.all('drive/orders').getList({ nesting : 1 }).then(function(orders) {
		$scope.orders = orders;
	});
});