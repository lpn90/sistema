angular.module('app.controllers')
    .controller('RefreshModalController',
        ['$rootScope', '$scope', '$location', '$interval', '$uibModalInstance',
            'authService', 'OAuth', 'OAuthToken', 'User',
            function ($rootScope, $scope, $location, $interval, $uibModalInstance,
                      authService, OAuth, OAuthToken, User) {

                $scope.$on('event::auth-loginConfirmed', function () {
                    $rootScope.loginModalOpened = false;
                    $uibModalInstance.close();
                });

                $scope.$on('$routeChangeStart', function () {
                    $rootScope.loginModalOpened = false;
                    $uibModalInstance.dismiss('cancel');
                });

                $scope.$on('event::auth-loginCancelled', function () {
                    OAuthToken.removeToken();
                });

                $scope.cancel = function () {
                    authService.loginCancelled();
                    $location.path('login');
                };

                OAuth.getRefreshToken().then(function () {
                    $interval(function () {
                        authService.loginConfirmed();
                        $uibModalInstance.close();
                    }, 6000);
                }, function (data) {
                    $scope.cancel();
                });

            }]);