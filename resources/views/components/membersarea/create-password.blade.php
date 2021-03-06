<section id="login" class="login-section">
	<div class="container">
        <div class="row login-content">
            <div class="col-lg-6">
            	
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                        <label for="name" class="col-md-4 control-label">Username</label>

                        <div class="col-md-8">
                            <input id="name" type="text" class="form-control control-input" name="name" value="{{ old('name') }}">

                            @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>

                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control control-input" name="email" value="{{ old('email') }}">

                            @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        <label for="password" class="col-md-4 control-label">Password</label>

                        <div class="col-md-8">
                            <input id="password" type="password" class="form-control control-input" name="password">

                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>

                        <div class="col-md-8">
                            <input id="password-confirm" type="password" class="form-control control-input" name="password_confirmation">

                            @if ($errors->has('password_confirmation'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Submit
                            </button>
                        </div>
                    </div>
                </form>            	
            	
            	
            	
           		<!--<form>
            		<div class="col-lg-12">
            			<span id="returned_error" class="pull-left" style="font-size:14px;color:#d9534f;">  </span>
            			<span id="returned_success" class="pull-left" style="font-size:14px;color:#5cb85c;">  </span>
            			<br/><br/>
            		</div>
					<div class="col-lg-12 col-md-12 col-sm-12 contact-inner-form"> 
						<div class="form-group">
							<label for="register-email">Email *</label>
							<input type="text" id="register-email" name="register-email" class="form-control control-input" placeholder="Email" required>
						</div>
						<div class="form-group">
							<label for="new-password">New Password *</label>
							<input type="password" id="new-password" name="new-password" class="form-control control-input" placeholder="Password" required>
						</div>
						<div class="form-group">
							<label for="confirm-password">Confirm Password *</label>
							<input type="password" id="confirm-password" name="confirm-password" class="form-control control-input" placeholder="Password" required>
						</div>						
						<div class="form-group">
							<input type="button" id="login_submit" name="login_submit" class="btn btn-md btn-primary" value="Submit">
						</div>						
					</div>
				</form>-->
            </div>
        </div>
    </div>
	<div class="container-footer" style="margin-top: 7%">
    	@include('components.footer')
    </div>
</section>