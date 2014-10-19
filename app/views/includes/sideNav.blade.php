	<div class="row sideNav">
		@foreach (Helper::getPublicPages('side') as $key => $menu)
			<div class="col-md-2 nav-item">
	    		<a href="{{ URL::to($menu->page->url) }}">
					<span class="icon fa {{ $menu->page_icon }}"></span><br/>
					{{ $menu->page->title }}
				</a>
			</div>
        @endforeach
	</div>

	<div class="clearfix"></div>