angular.module('app.controllers')
    .controller('ClientDashboardController',
        ['$scope', '$location', 'Client', '$routeParams', 'appConfig',
            function ($scope, $location, Client, $routeParams, appConfig) {
            $scope.client = {};
            $scope.status = appConfig.project.status;
            
            Client.query({
                orderBy: 'created_at',
                sortBy: 'desc',
                limit: 8
            }, function (response) {
                $scope.clients = response.data;
            });

            $scope.showClient = function (client) {
                $scope.client = client;
            }
        }]);