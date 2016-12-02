angular.module('app.controllers')
    .controller('ProjectNoteShowController',
        ['$scope', '$location', 'Client', '$routeParams', function ($scope, $location, Client, $routeParams) {
        $scope.client = Client.get({id: $routeParams.id});

        $scope.error = {
            message: '',
            error: false
        };

        $scope.save = function () {
            if ($scope.form.$valid){
                Client.update({id: $scope.client.id}, $scope.client, function (data) {
                    if(data.error){
                        $scope.error.error = true;
                        $scope.error.message = data.message;
                    }else{
                        $location.path('/clients');
                    }
                });
            }
        }
    }]);