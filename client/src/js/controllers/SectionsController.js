stockManager.controller('SectionsAddController', function ($scope, $location, Restangular) {
	$scope.title = 'Ajout';

	$scope.section = {};

	$scope.save = function() {
		Restangular.all('sections').post($scope.section).then(function() {
			$location.path('/sections/list');
		});
	};
});

stockManager.controller('SectionsEditController', function ($scope, $routeParams, Restangular) {
	$scope.title = 'Édition';

	Restangular.one("sections", $routeParams.id).get({ nesting : 1 }).then(function(section) {
		$scope.section = section;
	});

	$scope.save = function() {
		$scope.section.put();
	};
});

stockManager.controller('SectionsListController', function ($scope, $route, Restangular) {
	Restangular.all('sections').getList().then(function(sections) {
		$scope.sections = sections;
	});

	$scope.delete = function(index) {
		$scope.sections[index].remove().then(function() {
			$route.reload();
		});
		$scope.sections.splice(index, 1);
	};
});