<style>
.navbar-default {
    background: rgba(0, 0, 0, 0.9);
    border-color: #E7E7E7;
    border-bottom: 0px;
}
/* title */
.navbar-default .navbar-brand {
    color: #777;
}
.navbar-default .navbar-brand:hover,
.navbar-default .navbar-brand:focus {
    color: #5E5E5E;
}
/* link */
.navbar-default .navbar-nav > li > a {
	font-size: 18px;
    color: #ddd;
}
.navbar-default .navbar-nav > li > a:hover{
	color: rgb(34, 74, 221);
}
.navbar-default .navbar-nav > li > a:focus {
	background: linear-gradient(rgba(0, 0, 0, 0.8),rgba(0, 0, 0, 0.8));
	color: #fff;
}
.navbar-default .navbar-nav > .active > a, 
.navbar-default .navbar-nav > .active > a:hover, 
.navbar-default .navbar-nav > .active > a:focus {
    /*background-color: #E7E7E7;*/
    background: #FFF;
}
.navbar-default .navbar-nav > .open > a, 
.navbar-default .navbar-nav > .open > a:hover, 
.navbar-default .navbar-nav > .open > a:focus {
    color: #555;
    background: #FFF;
}
/* caret */
.navbar-default .navbar-nav > .dropdown > a .caret {
    border-top-color: #777;
    border-bottom-color: #777;
}
@media(min-width:767px) {
    .navbar {
        padding: 0px 0;
        -webkit-transition: background .5s ease-in-out,padding .5s ease-in-out;
        -moz-transition: background .5s ease-in-out,padding .5s ease-in-out;
        transition: background .5s ease-in-out,padding .5s ease-in-out;
        background: rgba(0, 0, 0, 0.9);       
    }

    .top-nav-collapse {
        padding: 0;
        border-bottom: 1px solid #ddd;
    }
}
</style>
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header page-scroll">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <!--<a class="navbar-brand page-scroll" href="#page-top"><img style="height:30px;margin-top:-5px;" src="./images/logo.png"></a>-->
        </div>
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav">
                <li class="hidden">
                    <a class="page-scroll" href="#page-top"></a>
                </li>
                @if (!Auth::check())
                <li>
                    <a class="page-scroll" href="membersarea">Log in</a>
                </li>
                <li>
                    <a class="page-scroll" href="create-password">Create password</a>
                </li>
                <li>
                    <a class="page-scroll" href="forgot-password">Forgot password?</a>
                </li>
                @else                
                <li>
                    <a class="page-scroll" href="yeeperks"><i class="fa fa-gift" aria-hidden="true"></i> Perks</a>
                </li>                
                <li>
                    <a class="page-scroll" href="profile"><i class="fa fa-user" aria-hidden="true"></i> Profile</a>
                </li>                
                @endif
            </ul>
            @if (Auth::check())
            <ul class="nav navbar-nav pull-right">
				<li>
					<a href="logout"> <i class="fa fa-power-off" aria-hidden="true"></i> Exit </a>
				</li> 				
			</ul>
            @endif
        </div>
    </div>
</nav>
