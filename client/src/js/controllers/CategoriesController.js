stockManager.controller('CategoriesAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.category = {};

	Restangular.all("sections").getList().then(function(sections) {
		$scope.sections = sections;
	});

	$scope.save = function() {
		Restangular.all('categories').post($scope.category).then(function() {
			$location.path('/categories/list');
		});
	};
});

stockManager.controller('CategoriesEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("categories", $routeParams.id).get({ nesting : 1 }).then(function(category) {
		$scope.category = category;
	});
	Restangular.all("sections").getList().then(function(sections) {
		$scope.sections = sections;
	});

	$scope.save = function() {
		$scope.category.put();
	};
});

stockManager.controller('CategoriesListController', function ($scope, $route, Restangular) {
	Restangular.all('categories').getList().then(function(categories) {
		$scope.categories = categories;
	});

	$scope.delete = function(index) {
		$scope.categories[index].remove().then(function() {
			$route.reload();
		});
		$scope.categories.splice(index, 1);
	};
});