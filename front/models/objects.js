'use strict';
yii2AngApp_object.factory("services", ['$http','$location','$route', 
    function($http,$location,$route) {


    var obj = {};

    obj.getObjects = function(page,perpg){        
        return $http.get(serviceBase + 'objects/default?page='+page+'&per-page='+perpg);
    }    

    obj.createObjects = function (object) {
        return $http.post( serviceBase + 'objects/default/create', object )
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $location.path('/object/index');            
        }
        function errorHandler( result ){
            alert("Error data")
            $location.path('/object/create')
        }
    };    
    obj.getObject = function(objectID){
        return $http.get(serviceBase + 'objects/default/' + objectID);
    }
 
    obj.updateObject = function (object) {
        return $http.put(serviceBase + 'objects/default/update?id=' + object.id, object )
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $location.path('/object/index');
        }
        function errorHandler( result ){
            alert("Error data")
            $location.path('/object/update/' + object.id)
        }    
    };    
    obj.deleteObject = function (objectID) {
        return $http.delete(serviceBase + 'objects/default/delete?id='+objectID)
            .then( successHandler )
            .catch( errorHandler );
        function successHandler( result ) {
            $route.reload();
        }
        function errorHandler( result ){
         //   alert("Error data")
            $route.reload();
        }    
    };    
    return obj;   
}]);