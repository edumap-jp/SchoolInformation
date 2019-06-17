/**
 * SchoolInformationEdit Javascript
 */
NetCommonsApp.controller('SchoolInformationEdit',
    ['$scope',
      function($scope) {

  $scope.init = function(schoolInformation) {
    $scope.schoolInformation = schoolInformation;
  }
        /**
         * tinymce
         *
         * @type {object}
         */
        // $scope.tinymce = NetCommonsWysiwyg.new({height: 280});
        //
        // $scope.writeBody2 = false;
        //
        // $scope.init = function(data) {
        //   if (data.BlogEntry) {
        //     $scope.blogEntry = data.BlogEntry;
        //     if ($scope.blogEntry.body2 !== null) {
        //       if ($scope.blogEntry.body2.length > 0) {
        //         $scope.writeBody2 = true;
        //       }
        //     }
        //   }
        // };
        //
        // $scope.blogEntry = {
        //   body1: '',
        //   body2: '',
        //   publish_start: ''
        // };
      }
    ]
);


/**
 * Load  Event and Resize Event
 *
 * @param {string} Controller name
 * @param {function()} Controller
 */
$(window).on('load resize', function() {
  var photo = $('.school-cover-picture'), header = $('#container-header');
  photo.width(header.innerWidth());
  photo.height(header.innerHeight());
});
