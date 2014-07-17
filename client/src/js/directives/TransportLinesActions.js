stockManager.directive('transportLinesActions', ['$rootScope', function($rootScope) {
    return {
        scope: true,
        controller: function($scope) {
            $scope.add = function() {
                $rootScope.$broadcast('transportLines:add');
            };

            $scope.edit = function(line) {
                $rootScope.$broadcast('transportLines:edit', line);
            };
        }
    };
}]);