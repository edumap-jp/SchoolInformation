/**
 * SchoolInformationEdit Javascript
 */
NetCommonsApp.controller('SchoolInformationEdit',
    ['$scope', function($scope) {
      $scope.init = function(schoolInformation) {
        $scope.schoolInformation = schoolInformation;
      };
    }]);
