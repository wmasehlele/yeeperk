<section id="contact" class="contact-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1><span style="color:rgb(34, 74, 221)">CONTACT</span> US</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 contact-content-details">
            	<br/></br/></br/>
				<div class="col-lg-6 col-md-6 col-sm-6 services-inner-detail">
					<div class="icons"> <i class="fa fa-phone-square" aria-hidden="true"></i>  <h3>+2772 653 2438</h3></div>
				</div>
				<!--<div class="col-lg-6 col-md-6 col-sm-6 services-inner-detail">-->
				<!--	<div class="icons"> <i class="fa fa-phone-square" aria-hidden="true"></i>  <h3>Connect on Facebook</h3></div>-->
				<!--</div>				-->
				<div class="col-lg-6 col-md-6 col-sm-6 services-inner-detail">
					<div class="icons"><i class="fa fa-envelope" aria-hidden="true"></i>  <h3>info@yeeperk.co.za</h3></div>
				</div>				
            </div>
        </div> 
    </div>
    <div class="container">
        <div class="row">
            <div class="col-lg-12 contact-content-form">
            	<br/>
            	<form>
            		<div class="col-lg-12">
            			<span ng-if="returned == '1'" class="pull-left" style="font-size:14px;color:#d9534f;"> {[returned_error]} </span>
            			<span ng-if="returned == '2'" class="pull-left" style="font-size:14px;color:#5cb85c;"> {[returned_success]} </span>
            			<br/><br/>
            		</div>
					<div class="col-lg-6 col-md-6 col-sm-6 contact-inner-form"> 
						<div class="form-group">
							<label for="client_names">Name and surname *</label>
							<input type="text" id="client_names" ng-model="client_names" class="form-control control-input" placeholder="Name and surname" required>
						</div>
						<div class="form-group">
							<label for="client_email">Email *</label>
							<input type="email" id="client_email" ng-model="client_email" class="form-control control-input" placeholder="Email" required>
						</div>						
						<div class="form-group">
							<label for="client_contact_number">Contact number *</label>
							<input type="text" id="client_contact_number" ng-model="client_contact_number" class="form-control control-input" placeholder="Contact number" required onkeypress="return isNumber(event)" >
						</div>	
						<div class="form-group">
							<label for="client_type">Employer or merchant</label>
							<select id="client_type" ng-model="client_type" class="form-control control-input">
								<option value="Employer">Employer</option>
								<option value="Merchant">Merchant</option>
							</select>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 services-inner-form">
						<div class="form-group">
							<label for="reason_for_contact">Reason for contact</label>
							<select id="reason_for_contact" ng-model="reason_for_contact" class="form-control control-input">
								<option value="General inquiry">General inquiry</option>
								<option value="I want to be yeeperk merchant">I want to be yeeperk merchant</option>
								<option value="Interested in 1-10 Employees">Interested in 1-10 Employees</option>
								<option value="Interested in 11-50 Employees">Interested in 11-50 Employees</option>
								<option value="Interested in 51-250 Employees">Interested in 51-250 Employees</option>
								<option value="Interested in 250 Plus Employees">Interested in 250 Plus Employees</option>
							</select>
						</div>
						<div class="form-group">
							<label>
								<input type="checkbox" id="client_want_trial" ng-model="client_want_trial" class="control-input">
								Would you like a trial.
							</label>
						</div>						
						<div class="form-group">
							<label for="client_message">Message *</label>
							<textarea id="client_message" ng-model="client_message" class="form-control control-input" placeholder="Your message..." rows="3" required></textarea>
						</div>
						<div class="form-group">
							<input type="button" id="_client_submit" ng-click="send()" class="btn btn-md btn-primary" value="Submit">
						</div>						
					</div>
				</form>
            </div>
        </div>
    </div>
	<div class="container-footer">
    	@include('components.footer')
    </div>  
</section>