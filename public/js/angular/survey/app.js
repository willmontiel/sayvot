angular.module('sayvot', ['ui-notification', 'ngMaterial'])
    .config(function(NotificationProvider) {
        NotificationProvider.setOptions({
            delay: 10000,
            startTop: 100,
            startRight: 10,
            verticalSpacing: 20,
            horizontalSpacing: 20,
            positionX: 'right',
            positionY: 'top'
        });
    })
    .factory('main', ['$http', '$window', '$q', 'Notification', function ($http, $window, $q, Notification) {
        function sendDataForCreateSurvey(data) {
            var deferred = $q.defer();
            $http.post('new', data)
                .success(function(data) {
                    deferred.resolve(data);
                })
                .error(function(data){
                    deferred.reject(data);
                    Notification.error(data.message);
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
                    Notification.error(data.message);
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
                    Notification.error("Ocurrió un error mientras se listaban los sub-temas, por favor contacta a soporte");
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
                    Notification.error("Ocurrió un error mientras se listaba el contenido del sub-tema seleccionado, por favor contacta a soporte");
                });

            return deferred.promise;
        }
        
        function validateData(data) {
          if (data.name === undefined || !data.name.length || data.name.length > 80 ) {
            Notification.warning("Debes enviar un nombre valido, este no debe estar vacio y debe contener entre 2 y 80 caracteres");
            return false;
          } else if (data.subtopicContent === undefined || !data.subtopicContent.length) {
            Notification.warning("Debes seleccionar el contenido del sub-tema, recuerda seleccionar antes tema y sub-tema respectivamente");
            return false;
          }
          return true;
        }
        
        return {
          save: sendDataForCreateSurvey,
          getSubjects: getSubjects,
          getSubtopics: getSubtopics,
          getSubtopicsContent: getSubtopicsContent,
          validateData: validateData,
        };
      }])
    .controller('ctrlNewSurvey', ['$rootScope', '$scope', '$http', 'main', '$window', 'Notification', function ($rootScope, $scope, $http, main, $window, Notification) {
        $scope.subjectOpen = function () {
          main.getSubjects().then(function (data) {
            $scope.subjects = data;
          });
        },
        
        $scope.subjectChange = function () {
          main.getSubtopics($scope.subject).then(function (data) {
            $scope.subtopics = data;
            $scope.subtopicsContent = {};
            $scope.subtopic = null;
            $scope.subtopicContent = null;
          });
        },
        
        $scope.subtopicChange = function () {
          main.getSubtopicsContent($scope.subtopic).then(function (data) {
            $scope.subtopicsContent = data;
          });
        },
            
        $scope.newSurvey = function () {var data = {
            name: $scope.name,
            subtopicContent: $scope.subtopicContent
          };
          
          if (main.validateData(data)) {
            main.save(data).then(function (data){
            //$window.location.href = '#/';
            });
          }
        }
      }]);