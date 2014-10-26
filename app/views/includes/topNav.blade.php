<div class="top-bar clearfix">
    <div class="pull-left user-nav">
        <a href="http://www.sust.edu">{{ Config::get('myConfig.tagName') }}</a>
    </div>
    <div class="pull-right user-nav">
        @if(!Auth::check())
			<a href="{{ URL::route('login') }}">Login</a>
			 /
			<a href="{{ URL::route('register') }}">Register</a>
		@else
			<a href="{{ URL::route('profile.show') }}">Profile</a>
			 /
			<a href="{{ URL::route('logout') }}">Logout</a>
		@endif
    </div>
</div>
<nav class="navbar navbar-custom" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ URL::route('home') }}">
            <img src="{{URL::to('img/logo.jpg')}}" alt="CSE">
        </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            {{ Helper::buildTopNavHTML() }}
        </ul>
    </div>
</nav>