angular.module('sayvot', [])
    .factory('main', ['$http', '$window', function ($http, $window) {
        return {
          registerAccount: function (data, success, error) {
            $http.post('new', data).success(success).error(error);
          }
        }
      }])
    .controller('ctrlNewSurvey', ['$rootScope', '$scope', '$http', 'main', '$window', function ($rootScope, $scope, $http, main, $window) {
        $scope.newSurvey = function () {
          var data = {
            name: $scope.name,
            idSubtopicContent: $scope.phone
          };
          main.registerAccount(data, function (res) {
            var route = $window.myBaseURL + "account/";
            $window.location.href = route;
          }, function (res) {
            slideOnTop(res[0], 3000, "glyphicon glyphicon-remove-sign", "danger");
            $rootScope.error = 'fail';
          });
        }
      }]);