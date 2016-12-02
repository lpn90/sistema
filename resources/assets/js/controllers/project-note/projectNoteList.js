angular.module('app.controllers')
    .controller('ProjectNoteListController',
        ['$scope', 'ProjectNote', '$routeParams', function ($scope, ProjectNote, $routeParams) {
        $scope.projectNotes = ProjectNote.query({id: $routeParams.id});
    }]);