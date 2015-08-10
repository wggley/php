angular.module('helloWorldApp', [])
  .controller('HelloWorldController', ['$scope', function($scope) {
    $scope.firstName = "";
    $scope.lastName = "";
    $scope.getFullName = function() {
      return $scope.firstName + " " + $scope.lastName;
    };
  }]);