@if(Auth::check() && Session::get('role') == 1)
<nav class="navbar navbar-default" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="{{ URL::route('home') }}">Admin Panel</small></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <li><a href="{{ URL::route('admin.notices') }}">Notices</a></li>
            <li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li><a href="{{ URL::route('admin.students') }}">Students</a></li>
                </ul>
            </li>
            <li><a href="{{ URL::route('admin.menu.build') }}">Menus</a></li>
            <li><a href="{{ URL::route('admin.batches') }}">Batches</a></li>
            <li><a href="{{ URL::route('admin.faqs') }}">FAQ's</a></li>
        </ul>
    </div>
</nav>
@endif