<?php 
    $sideMenus = Helper::getPublicPages('side');
?>
<div class="col-md-3">
	<div class="row-fluid sideNav">
		@foreach ($sideMenus as $key => $menu)
    		<a href="{{ URL::to($menu->page->url) }}">
				<div class="col-md-6">
					<span class="icon fa {{ $menu->page_icon }}"></span><br/>
    				{{ $menu->page->title }}
			    </div>
			</a>
        @endforeach
	</div>
</div>