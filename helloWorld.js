angular.module('helloWorldApp', [])
  .controller('HelloWorldController', ['$scope', function($scope) {
    $scope.name = "";
    $scope.lastName = "";
    $scope.getName = function() {
      return $scope.name + " " + $scope.lastName;
    };
  }]);