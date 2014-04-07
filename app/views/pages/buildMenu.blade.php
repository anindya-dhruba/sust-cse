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

		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<ul class="list-group" id="all_menus">
					@foreach ($pages as $key => $page)
					  	<li class="list-group-item" id="orders_{{ $page->id }}"><span class="glyphicon glyphicon-move"></span> {{ $page->title }}</li>
					@endforeach
				</ul>	
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

						$.post("{{ URL::route('pages.buildMenu') }}", order, function(response) {
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
	</style>

@stop