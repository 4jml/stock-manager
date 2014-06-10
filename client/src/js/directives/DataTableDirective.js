stockManager.directive('datatable', ['Restangular', '$timeout', function(Restangular, $timeout) {
	return {
		link: function($scope, element, attrs) {
			$scope.$watch(attrs.watch, function(newValue, oldValue){
				if(typeof newValue != "undefined")
					$timeout(function(){element.dataTable()},0);
			});
		}
	};
}]);