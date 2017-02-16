<section id="login" class="login-section" ng-app="myApp" ng-controller="MembersareaController">
	<div class="container">
        <div class="row login-content">
            <div class="col-lg-6">
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        <label for="email" class="col-md-4 control-label">Email</label>
                        <div class="col-md-8">
                            <input id="email" type="email" class="form-control  control-input" name="email" value="{{ old('email') }}">
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
                            <input id="password" type="password" class="form-control  control-input" name="password">
                            @if ($errors->has('password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-sign-in"></i> Login
                            </button>
                            <a class="btn btn-link" href="{{ url('/forgot-password') }}">Forgot Your Password?</a>
                        </div>
                    </div>
                </form>            	
            </div>
            <div class="col-lg-6">
        		<h4>
        			Log in to browse our perks. Yeeperk brings to you products and services with disscount rates that are exclusively designed for yeeperk members.
        		</h4>
            </div>
        </div>
    </div>
	<div class="container-footer" style="margin-top: 10%">
    	@include('components.footer')
    </div>
</section>