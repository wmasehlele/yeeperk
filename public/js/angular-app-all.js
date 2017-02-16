var myApp = angular.module('myApp', ['ngRoute']);
myApp.config(['$routeProvider', '$interpolateProvider', function($routeProvider, $interpolateProvider){
	$interpolateProvider.startSymbol('{[');
	$interpolateProvider.endSymbol(']}');
}]);

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

myApp.controller('WebContactsController', function($scope, $http){
	$scope.returned = 0;
	$scope.returned_error = "";
	$scope.returned_success = "";
	
	$scope.send = function(){
		$scope.returned = 0;
		$scope.returned_error = "";
		$scope.returned_success = "";
		var postdata = {};
		postdata.names = $scope.client_names;
		postdata.email = $scope.client_email;
		postdata.contact_number = $scope.client_contact_number;
		postdata.client_type = $scope.client_type;
		postdata.reason_for_contact = $scope.reason_for_contact;
		postdata.message = $scope.client_message;
		postdata.activate_trial = $scope.client_want_trial;
		
		if (postdata.names === "" || postdata.email === "" || postdata.contact_number === "" || postdata.message === ""){
			$scope.returned = 1;
			$scope.returned_error = "Fill in all the required fields.";
			return;
		}
		if (!validateEmail(postdata.email)){
			$scope.returned = 1;
			$scope.returned_error = "Provide a valid email.";
			return;
		}
		
		$http({
			method: "POST",
			url: "web/api-web-contact",
			data: postdata,
		}).then(function onSuccessCallback(respdata){
			if (respdata.status == true){
				$scope.returned = 2;
				$scope.returned_success = respdata.message;
				return;
			}
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		},function errorCallback(respdata){
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		});	
	};
});
myApp.controller('MembersareaController', function($scope, $http, $window){
	
	$scope.returned = 0;
	$scope.returned_error = "";
	$scope.returned_success = "";
	
	$scope.data = {};
	$scope.data.perks = [];
	$scope.data.categories = [];
	$scope.data.selected_view = "perks";
	$scope.data.selected_perk = [];
	
	$scope.selectView = function (selectedView){
		$scope.data.selected_view = selectedView;
	}

	$scope.loadPerks = function (){
		$http({
			method: "GET",
			url: "perks/api-load-perks",
		}).then(function onSuccessCallback(respdata){
			$scope.data.perks = respdata.perks;
			$scope.data.categories = respdata.categories;
		},function errorCallback(respdata){
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		});		
	};
	
	$scope.login = function(){

		$scope.returned = 0;
		$scope.returned_error = "";
		$scope.returned_success = "";

		var postdata = {};
		postdata.email = $scope.email;
		postdata.password = $scope.password;
		
		if (postdata.email == "" || postdata.password == ""){
			$scope.returned = 1;
			$scope.returned_error = "Fill in all the required fields.";
			return;
		}
		if (!validateEmail(postdata.email)){
			$scope.returned = 1;
			$scope.returned_error = "Provide a valid email.";
			return;
		}			
		$http({
			method: "POST",
			url: "accounts/api-do-login",
			data: postdata,
		}).then(function onSuccessCallback(respdata){
			if (respdata.status == true){
				$scope.returned = 2;
				$scope.returned_success = respdata.message;
				window.location.href = '/membersarea';
				return;
			}
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		},function errorCallback(respdata){
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		});	
	};
});
//# sourceMappingURL=angular-app-all.js.map
