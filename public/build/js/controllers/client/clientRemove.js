angular.module('app.controllers')
    .controller('ClientRemoveController',
        ['$scope', '$location', 'Client', '$routeParams', function ($scope, $location, Client, $routeParams) {

        $scope.client = Client.get({id: $routeParams.id});

        $scope.error = {
            message: '',
            error: false
        };

        $scope.remove = function () {
            $scope.client.$delete().then(function (data) {
                if(data.error){
                    $scope.error.error = true;
                    $scope.error.message = data.message;
                }else{
                    $location.path('/clients');
                }
            });
        }
    }]);