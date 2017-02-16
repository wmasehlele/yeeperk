<!DOCTYPE html>
<?php
	if(isset($_REQUEST['email'])){
		$to = "tshiamo@yeeperk.co.za";
		$subject = "YeePerk, Contact us";
		$txt = "Dear Honcho, a communication from a potential client for YeePerk. Here is the email address: ".$_REQUEST['email'];
		$headers = "From: ". $_REQUEST['email'] . "\r\n" .
		"CC: william@yeeperk.co.za";
		mail($to,$subject,$txt,$headers);
	}
?>
<html>
    <head>
        <title>YeePerk-Be right back</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:300" rel="stylesheet" type="text/css">
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" type="text/css">
		
        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                font-weight: 300;
                font-family: 'Lato';
                font-size: 18px;
            }

            .container {
                text-align: center;
                padding-top: 10%;
            }
            .title {
                font-size: 72px;
                margin-bottom: 40px;
            }
            .email{
            	height: 50px;
            	font-size: 25px;
            	margin-top: 10px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
            	<div class="row">
	            	<div class="col-lg-12">
	            		<img src="./images/logo.png" class="img-thumbnail" style="max-width: 40%;, height: auto;">
	            	</div>             		
	            	<div class="col-lg-12">
	            		<br/><br/>
						<h4>
						Running a company is not easy.<br/>
						Get Exclusive discounts on tools that your company needs to thrive and on brands that will help your
						employees thrive at work and in life. <br/>
						YeePerk gives your company and employees access to exclusive benefits and discounts of up to 50% on:	            		
						</h4>
	            	</div>            	            		
            	</div>
            	<div class="row">
	            	<div class="col-lg-4">
						<h3><b>Business</b></h3>
						<p>- Software and Apps</p>
						<p>- Office hardware and furniture</p>
						<p>- Wi-Fi, Data, technology Telecommunications</p>
						<p>- Professional services</p>
	            	</div>            	
	            	<div class="col-lg-4">
						<h3><b>Employees</b></h3>
						<p>- Health and fitness</p>
						<p>- Food</p>
						<p>- Clothing</p>
						<p>- Entertainment</p>
	            	</div> 
	            	<div class="col-lg-4">
						<h3><b>and others including...</b></h3>
						<p>- Automotive</p>
						<p>- Electronics</p>
						<p>- Travel</p>
						<p>- Accommodation</p>
	            	</div>	            	
            	</div>            	
                <form method="POST" action="index.php">
	            	<div class="row">
		            	<div class="col-lg-12">
		            		<br/><br/>
							<h4 class="pull-left">
								Submit your email bellow for more details and alert when we go live.	            		
							</h4>
		            	</div>            	            		
	            	</div>                	
	                <div class="row">
	                	<div class="col-lg-9">
			                <input type="email" class="form-control email" name="email" id="email" placeholder="email" required>
	                	</div>
	                	<div class="col-lg-3">
			                <input type="submit" class="form-control btn btn-success email" name="btn-submit" id="btn-submit" value="Submit">
	                	</div>                	
	                </div>
                </form>
            </div>
        </div>
    </body>
</html>