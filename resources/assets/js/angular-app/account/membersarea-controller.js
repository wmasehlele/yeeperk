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
			url: "login",
			data: postdata,
		}).then(function onSuccessCallback(respdata){
			if (respdata.status == true){
				$scope.returned = 2;
				$scope.returned_success = respdata.message;
				window.location.href = 'membersarea';
			}
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		},function errorCallback(respdata){
			$scope.returned = 1;
			$scope.returned_error = "Error occured, please try again.";
		});	
	};
});