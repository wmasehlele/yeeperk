<section id="login" class="login-section" ng-app="myApp" ng-controller="MembersareaController">
	<div class="container">
        <div class="row login-content">
            <div class="col-lg-6">
           		<form>
            		<div class="col-lg-12">
            			<span id="returned_error" class="pull-left" style="font-size:14px;color:#d9534f;">  </span>
            			<span id="returned_success" class="pull-left" style="font-size:14px;color:#5cb85c;">  </span>
            			<br/><br/>
            		</div>
					<div class="col-lg-12 col-md-12 col-sm-12 contact-inner-form"> 
						<div class="form-group">
							<label for="login-email">Email *</label>
							<input type="text" id="login-email" ng-model="email" name="email" class="form-control control-input" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="login-password">Password *</label>
							<input type="password" ng-model="password" name="password" class="form-control control-input" placeholder="Password" required>
						</div>						
						<div class="form-group">
							<input type="button" ng-click="login()" name="login_submit" class="btn btn-md btn-primary" value="login">
						</div>						
					</div>
				</form>
            </div>
            <div class="col-lg-6">
            	<div class="col-lg-12">
            		<br/>
            	</div>
            	<div class="col-lg-12">
            		<h4>
            			Log in to browse our perks. Yeeperk brings to you products and services with disscount rates that exclusively designed for yeeperk members.
            		</h4>
            	</div>
            </div>
        </div>
    </div>
	<div class="container-footer" style="margin-top: 10%">
    	@include('components.footer')
    </div>
</section>