'use strict';

// Ссылка на серверную часть приложения
var serviceBase = 'http://spa-back.com/';
// Основной модуль приложения и его компоненты
var yii2AngApp = angular.module('yii2AngApp', [
  'ngRoute',
  'yii2AngApp.site',
  'yii2AngApp.object',
  'services.authInterceptor'
]);
// рабочий модуль
var yii2AngApp_site = angular.module('yii2AngApp.site', ['ngRoute','services.authInterceptor']);
var yii2AngApp_object = angular.module('yii2AngApp.object', ['ngRoute','services.authInterceptor']);
 
yii2AngApp.config(['$routeProvider', function($routeProvider) {

  // Маршрут по-умолчанию
  $routeProvider.otherwise({redirectTo: '/site/index'});
}]);

  angular.module("services.authInterceptor", [])
.factory("authInterceptor", function ($q, $window, $location) { 
  return {
        request: function (config) {
        	 
                if ($window.sessionStorage.access_token) {
                //HttpBearerAuth
                config.headers.Authorization = 'Bearer ' + $window.sessionStorage.access_token;                
            }
            return config;
        },
        responseError: function (rejection) { 
            if (rejection.status === 401) {
                $location.path('/login').replace();
            }
            return $q.reject(rejection);
        }
    };
});

