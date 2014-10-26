@if(Auth::check() && $permission->adminMenu)
<nav class="navbar navbar-default navbar-admin" role="navigation">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse">
        <ul class="nav navbar-nav">
            <li class="active"><a href="{{ URL::route('home') }}">SUST CSE Home</a></li>
            @if($permission->notices)
                <li><a href="{{ URL::route('admin.notices') }}">Notices</a></li>
            @endif
            @if($permission->events)
            <li><a href="{{ URL::route('admin.events') }}">Events</a></li> 
            @endif
            @if($permission->pages)
            <li><a href="{{ URL::route('admin.pages') }}">Pages</a></li>
            @endif
            @if($permission->courses)
                <li><a href="{{ URL::route('admin.courses') }}">Courses</a></li>
            @endif
            @if($permission->researches)
                <li><a href="{{ URL::route('admin.researches') }}">Research</a></li>
            @endif
            @if($permission->batches)
            <li><a href="{{ URL::route('admin.batches') }}">Batches</a></li>
            @endif
            @if($permission->students || $permission->faculty || $permission->staff)
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Users <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @if($permission->faculty)
                        <li><a href="{{ URL::route('admin.faculty') }}">Faculty</a></li>
                    @endif
                    @if($permission->staff)
                        <li><a href="{{ URL::route('admin.staff') }}">Staff</a></li>
                    @endif
                    @if($permission->students)
                        <li><a href="{{ URL::route('admin.students') }}">Students</a></li>
                    @endif
                </ul>
            </li>
            @endif
            @if($permission->menus)
            <li><a href="{{ URL::route('admin.menu.build') }}">Menus</a></li>
            @endif
            @if($permission->albums || $permission->pictures || $permission->sliders)
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Gallery <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    @if($permission->albums)
                    <li><a href="{{ URL::route('admin.albums') }}">Albums</a></li>
                    @endif
                    @if($permission->pictures)
                    <li><a href="{{ URL::route('admin.pictures') }}">Pictures</a></li>
                    @endif
                    @if($permission->sliders)
                    <!-- <li><a href="{{-- URL::route('admin.slider') --}}">Home Slider</a></li> -->
                    @endif
                </ul>
            </li>
            @endif
            @if($permission->faqs)
            <li><a href="{{ URL::route('admin.faqs') }}">FAQ's</a></li>
            @endif
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="{{ URL::route('logout') }}">Logout</a></li>
        </ul>
    </div>
</nav>
@endif