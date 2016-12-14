/**
 * Created by Leonardo on 24/11/2016.
 */
angular.module('app.controllers')
    .controller('HomeController',['$scope', '$cookies', 'Project', 'appConfig',
        function ($scope, $cookies, Project, appConfig) {

        $scope.status = appConfig.project.status;
        $scope.project = {

        };

            Project.query({
                orderBy: 'created_at',
                sortedBy: 'desc'
            }, function (response) {
                $scope.projects = response.data;
            });

        $scope.showProject = function (project) {
            $scope.project = project;
        };

        $scope.getStatus = function($id) {
            for (var i = 0; i < $scope.status.length; i++) {
                if($scope.status[i].value === $id){
                    return $scope.status[i].label;
                }
            }
            return "";
        };

    }]);
