<nav class="navbar navbar-custom" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('home') }}">{{ Config::get('myConfig.siteName') }}<br/><small>{{ Config::get('myConfig.tagName') }}</small></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            
            {{ Helper::buildTopNavHTML() }}

            @if(!Auth::check())
                <li><a href="{{ URL::route('login') }}"><span class="glyphicon glyphicon-user"></span> Login</a></li>
            @else
                <li><a href="#">Profile</a></li>
                <li><a href="{{ URL::route('logout') }}">Logout</a></li>
            @endif
        </ul>
    </div>
</nav>