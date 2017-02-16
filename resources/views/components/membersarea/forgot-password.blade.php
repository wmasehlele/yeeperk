<section id="login" class="login-section">
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
							<label for="recover-password-email">Email *</label>
							<input type="text" id="recover-password-email" name="recover-password-email" class="form-control control-input" placeholder="Email" required>
						</div>
						<div class="form-group">
							<input type="button" id="recover_password_submit" name="recover_password_submit" class="btn btn-md btn-primary" value="Submit">
						</div>						
					</div>
				</form>
            </div>
        </div>
    </div>
	<div class="container-footer" style="margin-top: 15%">
    	@include('components.footer')
    </div>
</section>