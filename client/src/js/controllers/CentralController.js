stockManager.controller('CentralIndexController', function ($scope, Restangular) {
	Restangular.all("central/stocks").getList().then(function(products) {
		$scope.products = products;
	});

	$scope.load = function(product, action) {
		if (action) {
			if (typeof product.logs == "undefined") {
				Restangular.all("central/stocks/logs/" + product.id).getList().then(function(logs) {
					product.logs = logs;
					$scope.selectedProduct = product;
				});
			}
			else {
				$scope.selectedProduct = product;
			}
		}
		else {
			$scope.selectedProduct = null;
		}
	}
});