var bloknotApp = angular.module('bloknotApp', [
    'ngRoute',
    'bloknotControllers'
]);

bloknotApp.config(['$routeProvider',
    function($routeProvider) {
        $routeProvider.
            when('/notes', {
                templateUrl: 'partials/phone-list.html',
                controller: 'notesListController'
            }).
            when('/notes/:phoneId', {
                templateUrl: 'partials/phone-details.html',
                controller: 'noteDetailController'
            }).
            otherwise({
                redirectTo: '/notes'
            });
    }
]);