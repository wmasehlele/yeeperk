<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <meta name="description" content="">
	    <meta name="author" content="">
        <title>Yeeperk</title>
		<!-- styles -->
        <link href="https://fonts.googleapis.com/css?family=Lato:400" rel="stylesheet" type="text/css">
        <link href="./css/bootstrap/bootstrap.css" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="./font-awesome/css/font-awesome.min.css" type="text/css">
        <link href="./css/app-main-all.css" rel="stylesheet" type="text/css">
		<!-- required scripts -->
        <script src="./plugins/angular.min.js" type="text/javascript"></script>
        <script src="./plugins/jquery.min.js" type="text/javascript"></script>
        <script src="./plugins/bootstrap.min.js" type="text/javascript"></script>
        <script src="./plugins/jquery.easing.min.js" type="text/javascript"></script>
        <!-- scripts -->
        <script src="./js/app-main-all.js" type="text/javascript"></script>
        <!-- angular app scripts -->
    </head>
	<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
		@include('components.membersarea.nav-bar')
	    <!-- login Section -->
		@include('components.membersarea.reset-password')
    </body>
</html>