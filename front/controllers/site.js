'use strict';
yii2AngApp_site.config(['$routeProvider','$locationProvider','$httpProvider', function($routeProvider,$locationProvider,$httpProvider) {

 $httpProvider.interceptors.push('authInterceptor');
 

  $routeProvider
    .when('/site/index', {
        templateUrl: 'views/site/index.html',
        controller: 'index'
    })
    .when('/site/about', {
        templateUrl: 'views/site/about.html',
        controller: 'about'
    })
    .when('/site/contact', {
        templateUrl: 'views/site/contact.html',
        controller: 'contact'
    })    
    .when('/site/login', {
                templateUrl: 'views/site/login.html',
                controller: 'login'
            })
    .when('/site/dashboard', {
                templateUrl: 'views/site/dashboard.html',
                controller: 'dashboard'
            })
    .otherwise({
        redirectTo: '/site/index'
    });
  
     // use the HTML5 History API
        $locationProvider.html5Mode(true);
 


}])
.controller('index', ['$scope', '$http', '$location', '$window', function($scope,$http,$location,$window) {
 
     

    $scope.message = 'Вы читаете главную страницу приложения. ';

}])
.controller('about', ['$scope', '$http', function($scope,$http) {
    // Сообщение для отображения представлением
    $scope.message = 'Это страница с информацией о приложении.';
}])
.controller('contact', ['$scope', '$http', function($scope,$http) {
    // Сообщение для отображения представлением
    $scope.message = 'Пишите письма. Мы будем рады!.';
}])
.controller('login', ['$scope', '$http', '$window', '$location',
    function($scope, $http, $window, $location) {
        $scope.login = function () {
            $scope.submitted = true;
            $scope.error = {};
            $http.post(serviceBase + 'user/user-rest/login', $scope.userModel).success(
                function (data) {
                    $window.sessionStorage.access_token = data.access_token;                   
                    $location.path('/site/dashboard').replace();
            }).error(
                function (data) {
                    angular.forEach(data, function (error) {
                        $scope.error[error.field] = error.message;
                    });
                }
            );
        };
    }
])
.controller('dashboard', ['$scope', '$http', '$window', function($scope,$http,$window) {

          // Сообщение для отображения представлением
         $scope.loggedIn = function() {
                 return Boolean($window.sessionStorage.access_token);
             };
 
        $scope.logout = function () {
            delete $window.sessionStorage.access_token;
            $location.path('/site/login').replace();
        };
        $scope.dashboardtkn = 'token is '+$window.sessionStorage.access_token;
        
 
 
        $http.get(serviceBase + 'user/user-rest/dashboard').success(function (data) {
           $scope.dashboard = data;
        });
 
 
 

         
    
}]);