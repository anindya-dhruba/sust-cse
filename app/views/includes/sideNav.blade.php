	<div class="row-fluid sideNav">
		@foreach (Helper::getPublicPages('side') as $key => $menu)
    		<a href="{{ URL::to($menu->page->url) }}">
				<div class="col-md-6">
					<span class="icon fa {{ $menu->page_icon }}"></span><br/>
    				{{ $menu->page->title }}
			    </div>
			</a>
        @endforeach
	</div>

	<div class="clearfix"></div>

	<!-- recent notices -->
	<div class="panel panel-success vspace">
		<div class="panel-heading">Recent Notices</div>

		<div class="list-group">
			@foreach (Helper::recentNotices() as $key => $notice)
				<a href="{{ URL::route('notices.show', $notice->url) }}" class="list-group-item">
					<h5 class="list-group-item-heading"><strong>{{ $notice->title }}</strong></h5>
					<small>
						{{ Helper::date($notice->created_at) }}
					</small>
				</a>
			@endforeach
			<a href="{{ URL::route('notices') }}" class="list-group-item">
				<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View All Notices</h5>
			</a>
		</div>
	</div>