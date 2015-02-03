var bloknotControllers = angular.module('bloknotControllers', []);

bloknotControllers.controller('notesListController', ['$scope', '$http',
    function ($scope, $http) {
        $http.get('js/phones.json').success(function(data) {
            $scope.phones = data;
        });

        $scope.orderProp = 'age';
    }
]);

bloknotControllers.controller('noteDetailController', ['$scope', '$routeParams',
    function($scope, $routeParams) {
        $scope.phoneId = $routeParams.phoneId;
    }
]);