app.module('app.services')
    .service('Client', ['$resource', 'appConfig', function ($resource, appConfig) {
        return $resource(appConfig.config.baseUrl + '/client/:id', {id: '@id'});
    }]);