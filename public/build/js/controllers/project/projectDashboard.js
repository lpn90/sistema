angular.module('app.controllers')
    .controller('ProjectDashboardController',
        ['$scope', '$location', '$routeParams', 'Project', 'appConfig',
            function ($scope, $location, $routeParams, Project, appConfig) {
                
                $scope.project = {
                    
                };
                
                Project.query({
                    orderBy: 'created_at',
                    sortedBy: 'desc',
                    limit: 5
                }, function (response) {
                    $scope.projects = response.data;
                });
                
                $scope.showProject = function (project) {
                    $scope.project = project;
                };
                
            }]);