angular.module('app.controllers')
    .controller('ProjectRemoveController',
        ['$scope', '$location', 'ProjectNote', '$routeParams', function ($scope, $location, ProjectNote, $routeParams) {

            $scope.projectNote = ProjectNote.get({
                id: $routeParams.id,
                idNote: $routeParams.idNote
            });

        $scope.remove = function () {
            $scope.projectNote.$delete({
                id: null, idNote: $scope.projectNote.id}).then(function (data) {
                $location.path('/project/' + $routeParams.id + '/notes');
            });
        }
    }]);