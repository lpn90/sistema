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

                $scope.getStatus = function ($id) {
                    for (var i = 0; i < $scope.status.length; i++) {
                        if ($scope.status[i].value === $id) {
                            return $scope.status[i].label;
                        }
                    }
                    return "";
                };
            }]);