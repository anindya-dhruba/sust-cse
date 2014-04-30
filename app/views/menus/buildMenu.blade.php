@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>

		@if(count($pages) == 0)
			<div class="alert alert-danger" id="msg">
				No Page found. Try adding one first and make it publicly visible.
			</div>
		@else
			<div class="alert alert-success" id="msg">
				Drag and reposition the menu items below
			</div>
		@endif

	<div class="row"></div>
		<div class="col-md-4 col-md-offset-4">
			<div class="row sideNav" id="all_menus">
				@foreach ($pages as $key => $publicPage)
		        	@if($publicPage->page_type == 'custom')
						<div class="col-md-6" id="orders_{{ $publicPage->id }}">
							<span class="icon {{ $publicPage->page_icon }}"></span><br/>
		    				{{ $publicPage->page->title }}
					    </div>
		            @else
						<div class="col-md-6" id="orders_{{ $publicPage->id }}">
							<span class="icon {{ $publicPage->page_icon }}"></span><br/>
		    				{{ $publicPage->page_name }}
					    </div>
		            @endif
		        @endforeach
			</div>
		</div>
	</div>
		
	</div>

	<script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function() { 
			$("#all_menus").sortable(
				{
					opacity: .7,
					cursor: 'move',
					update: function() {
						var order = $(this).sortable("serialize");
						console.log(order);

						$.post("{{ URL::route('admin.menu.build') }}", order, function(response) {
							$("#msg").html(response);

							window.setTimeout(function () {
							    $("#msg").html('Drag and reposition the menu items below');
							}, 3000);

						});
				}		  
			});
		});
	</script>


	<style type="text/css">
	#all_menus
	{
		cursor: move;
	}
	#all_menus div
	{
		background: #eee;
		padding: 10px 0px;
		text-align: center;
		border: 1px solid #fff;
	}
	</style>

@stop