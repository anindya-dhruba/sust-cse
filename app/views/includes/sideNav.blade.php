<?php 
    $publicPages = Helper::getPublicPages();
?>

<div class="col-md-3">
	<div class="row-fluid sideNav">
		@foreach ($publicPages as $key => $publicPage)
        	@if($publicPage->page_type == 'custom')
        		<a class="{{ (Request::segment(1) ==  $publicPage->page->url) ? 'active' : '' }}" href="{{ URL::to($publicPage->page->url) }}">
					<div class="col-md-6">
					<span class="icon {{ $publicPage->page_icon }}"></span><br/>
        			{{ $publicPage->page->title }}
				    </div>
				</a>
            @else
            	<a class="{{ (Request::segment(1) ==  $publicPage->page_url) ? 'active' : '' }}" href="{{ URL::to($publicPage->page_url) }}">
					<div class="col-md-6">
					<span class="icon {{ $publicPage->page_icon }}"></span><br/>
        			{{ $publicPage->page_name }}
				    </div>
				</a>
            @endif
        @endforeach
	</div>
</div>