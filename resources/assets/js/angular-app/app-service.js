var myApp = angular.module('myApp');
myApp.service('DataStore', function(){
    var data = 0;
    var systemData = [];
    //exchange data between controllers.
    this.saveDetails = function(key,data){
        systemData.push = {'key':key, 'data':data};
    }
    this.getDetails = function(key){
        for (var x=0; x < systemData.length; x++){
            if (systemData[x].key == key){
                return systemData[x];
            }
        }
    }
});
myApp.service('Validator', function(){

});