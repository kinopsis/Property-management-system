'use strict';
yii2AngApp_object.config(['$routeProvider', function($routeProvider) {
  $routeProvider
    .when('/object/index', {
        templateUrl: 'views/object/index.html',
        controller: 'index'
    })
    .when('/object/create', {
        templateUrl: 'views/object/create.html',
        controller: 'create',
        resolve: {
            object: function(services, $route){                
                return services.getObjects();
            }
        }
    })
    .when('/object/update/:objectId', {
        templateUrl: 'views/object/update.html',
        controller: 'update',
        resolve: {
          object: function(services, $route){
            var objectId = $route.current.params.objectId;
            return services.getObject(objectId);
          }
        }
    })
    .when('/object/delete/:objectId', {
        templateUrl: 'views/object/index.html',
        controller: 'delete',
    })
    .otherwise({
        redirectTo: '/object/index'
    });
}]);
 
yii2AngApp_object
.controller('index', ['$scope', '$http', '$location', 'services', 
    function($scope,$http,$location,services) {

    $scope.message = 'Database of Property';

    //Get paging from response 
    function getPagingValues(hd){
        $scope.per_page = parseInt(hd.headers('x-pagination-per-page'));
        $scope.now_page = parseInt(hd.headers('X-Pagination-Current-Page'));
        $scope.page_count = parseInt(hd.headers('X-Pagination-Page-Count'));
        $scope.total_count = parseInt(hd.headers('X-Pagination-Total-Count'));
    }

    //defaul property list
    services.getObjects(1,20).then(function(data){
        getPagingValues(data);
        $scope.objects = data.data;

     });   

    //Next Page Go
    $scope.nextPageGo = function() {
        services.getObjects($scope.now_page+1,20).then(function(data){
        getPagingValues(data);
        $scope.objects = data.data;
        }); 
    };

    //Prev Page Go
    $scope.prevPageGo = function() {
        services.getObjects($scope.now_page-1,20).then(function(data){
        getPagingValues(data);  
        $scope.objects = data.data;
        }); 
    };


    $scope.deleteObject = function(objectID) {
        if(confirm("Are you sure to delete object number: " + objectID)==true && objectID>0){
            services.deleteObject(objectID);    
            $route.reload();
        }
    };
}])

.controller('create', ['$scope', '$http', 'services','$location','object', 
    function($scope,$http,services,$location,object) {
    $scope.message = 'Look! I am an about page.';
    $scope.createObjects = function(object) {
        var results = services.createObjects(object);
    }  
}])

.controller('update', ['$scope', '$http', '$routeParams', 'services','$location','object', 
    function($scope,$http,$routeParams,services,$location,object) {
    $scope.message = 'Contact us! JK. This is just a demo.';
    var original = object.data;
    $scope.object = angular.copy(original);
    $scope.isClean = function() {
        return angular.equals(original, $scope.object);
    }
    $scope.updateObject = function(object) {    
        var results = services.updateObject(object);
    } 
}]);