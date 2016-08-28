angular.module('sayvot', [])
    .factory('main', ['$http', '$window', '$q', function ($http, $window, $q) {
        function sendDataToCreateSurvey(data) {
            var deferred = $q.defer();
            $http.post('new', data)
                .success(function(data) {
                    deferred.resolve(data);
                })
                .error(function(data){
                    deferred.reject(data);
                    console.log(data);
                    //notificationService.error(data.message);
                });
            
            return deferred.promise;
        }
        
        function getSubjects() {
            var deferred = $q.defer();
            $http.get(myBaseURL + 'subject/getsubjects')
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (data){
                    deferred.reject(data);
                });
            return deferred.promise;
        }    
         
        function getSubtopics(id) {
            var deferred = $q.defer();
            $http.get(myBaseURL + 'subtopic/getsubtopics/' + id)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (data){
                    deferred.reject(data);
                });

            return deferred.promise;
        }
        
        function getSubtopicsContent(id) {
            var deferred = $q.defer();
            $http.get(myBaseURL + 'subtopiccontent/getsubtopicscontent/' + id)
                .success(function (data) {
                    deferred.resolve(data);
                })
                .error(function (data){
                    deferred.reject(data);
                });

            return deferred.promise;
        }
        
        return {
          save: sendDataToCreateSurvey,
          getSubjects: getSubjects,
          getSubtopics: getSubtopics,
          getSubtopicsContent: getSubtopicsContent,
        };
      }])
    .controller('ctrlNewSurvey', ['$rootScope', '$scope', '$http', 'main', '$window', function ($rootScope, $scope, $http, main, $window) {
        main.getSubjects().then(function (data) {
          $(".chosen").chosen();
            $scope.subjects = data;
        });
        
        $scope.subjectChange = function () {
          main.getSubtopics($scope.subject).then(function (data) {
            $scope.subtopics = data;
          });
        },
        
        $scope.subtopicChange = function () {
          main.getSubtopicsContent($scope.subtopic).then(function (data) {
            $scope.subtopicsContent = data;
          });
        },
            
        $scope.newSurvey = function () {
          var data = {
            name: $scope.name,
            idSubtopicContent: $scope.idSubtopicContent
          };
          
          main.save(data).then(function (data){
            console.log(data);
            //$window.location.href = '#/';
            //notificationService.success(data.message);
          });
        }
      }]);