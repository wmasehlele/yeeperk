<section id="login" class="login-section">
	<div class="container">
        <div class="row login-content">
            <div class="col-lg-6">
           		
                @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                @endif

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                    {{ csrf_field() }}

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

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-envelope"></i> Send Password Reset Link
                            </button>
                        </div>
                    </div>
                </form>           		
           		
           		

<!--           		<form>
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
-->				
				
            </div>
        </div>
    </div>
	<div class="container-footer" style="margin-top: 15%">
    	@include('components.footer')
    </div>
</section>