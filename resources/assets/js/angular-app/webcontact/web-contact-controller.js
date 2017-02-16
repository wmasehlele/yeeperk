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