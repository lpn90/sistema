angular.module('app.controllers')
    .controller('ProjectTaskListController',
        ['$scope', 'ProjectTask', '$routeParams', 'appConfig', function ($scope, ProjectTask, $routeParams, appConfig) {
            $scope.projectTask = new ProjectTask();

            $scope.save = function () {
                if ($scope.form.$valid){
                    $scope.projectTask.status = appConfig.projectTask.status[0].value;
                    $scope.projectTask.$save({id: $routeParams.id}).then(function () {
                        $scope.projectTask = new ProjectTask();
                        $scope.loadTask();
                    });
                }
            };

            $scope.loadTask = function() {
                $scope.projectTasks = ProjectTask.query({
                    id: $routeParams.id,
                    orderBy: 'id',
                    sortedBy: 'desc'
                });
            };

            $scope.loadTask();
    }]);