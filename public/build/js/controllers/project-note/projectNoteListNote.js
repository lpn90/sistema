angular.module('app.controllers')
    .controller('ProjectNoteListNoteController',
        ['$scope', '$location', 'ProjectNote', '$routeParams',
            function ($scope, $location, ProjectNote, $routeParams) {
                $scope.projectNote = ProjectNote.get({
                    id: $routeParams.id,
                    idNote: $routeParams.idNote
                });
            }]);