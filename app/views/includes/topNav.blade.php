<div class="top-bar clearfix">
    {{ Config::get('myConfig.tagName') }}
    <div class="pull-right user-nav">
        <a href="#">Login</a> / <a href="#">Register</a>
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

            @if(!Auth::check())
                <li><a href="{{ URL::route('login') }}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
            @else
                <li><a href="{{ URL::route('profile.show') }}"><span class="glyphicon glyphicon-user"></span> Profile</a></li>
                <li><a href="{{ URL::route('logout') }}">Logout</a></li>
            @endif
        </ul>
    </div>
</nav>