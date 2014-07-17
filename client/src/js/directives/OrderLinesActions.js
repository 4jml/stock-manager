stockManager.directive('orderLinesActions', ['$rootScope', function($rootScope) {
    return {
        scope: true,
        controller: function($scope) {
            $scope.add = function() {
                $rootScope.$broadcast('orderLines:add');
            };

            $scope.edit = function(line) {
                $rootScope.$broadcast('orderLines:edit', line);
            };
        }
    };
}]);