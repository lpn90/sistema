angular.module('app.controllers')
    .controller('ProjectListController',
        ['$scope', 'Project', '$routeParams', function ($scope, Project) {
        $scope.projects = Project.query();
    }]);