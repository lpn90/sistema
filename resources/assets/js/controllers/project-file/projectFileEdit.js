angular.module('app.controllers')
    .controller('ProjectFileEditController',
        ['$scope', '$location', 'ProjectFile', '$routeParams',
            function ($scope, $location, ProjectFile, $routeParams) {
                $scope.projectFile = ProjectFile.get({
                    id: null,
                    idFile: $routeParams.idFile
                });

                $scope.save = function () {
                    if ($scope.form.$valid) {
                        ProjectFile.update({
                            id: null, idFile: $routeParams.idFile
                        }, $scope.projectFile, function () {
                                $location.path('/project/' + $routeParams.id + '/files');
                        });
                    }
                }
            }]);