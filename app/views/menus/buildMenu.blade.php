@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		@if(count($allMenus) == 0)
			<div class="alert alert-danger">
				No Page found. Try adding one first and make it publicly visible.
			</div>
		@endif

		@include('includes.alert')

	<ul id="myTab" class="nav nav-tabs">
		<li class="active"><a href="#icon_and_position" data-toggle="tab">Manage Icon &amp; Position</a></li>
		<li><a href="#side_menu" data-toggle="tab">Manage Side Menu</a></li>
		<li><a href="#top_menu" data-toggle="tab">Manage Top Menu</a></li>
	</ul>
	
	<div id="myTabContent" class="tab-content">


		<div class="tab-pane fade active in" id="icon_and_position">
			{{ Form::open(array('route' => 'admin.selectIconLocation')) }}
				<br/>
				<table class="table table-bordered">
					<tr>
						<th>Page Name</th>
						<th>Select Icon</th>
						<th>Select Position</th>
					</tr>
					 @foreach ($allMenus as $key => $menu)
					 	<tr>
					 		<td>
								{{ $menu->page->title }}
							</td>
							<td>
								<button name="pages[{{ $menu->id }}]" class="btn btn-default" role="iconpicker" data-cols="6" data-icon="{{ $menu->page_icon }}" data-iconset="fontawesome"></button>
							</td>
							<td>
								@foreach (Menu::$menuPostions as $key => $position)
									<label class="checkbox-inline">
										{{ Form::radio("locations[$menu->id]", $key, ($menu->page_location == $key)) }}
										{{ $position }}
									</label>
								@endforeach
							</td>
						</tr>
			         @endforeach
		        </table>
				{{ Form::submit('Update Icon & Postion', array('class'=>'btn btn-success', 'data-loading-text'=>'Updating...', 'type' => 'button')) }}
			{{ Form::close() }}
		</div>


		<div class="tab-pane fade" id="side_menu">
			<div class="row">
				<div class="col-md-12 sideNav">
					<br/>
					<div id="side_menus">
						@foreach ($sideMenus as $key => $menu)
							<div class="col-md-6" id="orders_{{ $menu->id }}">
								<span class="icon fa {{ $menu->page_icon }}"></span><br/>
			    				{{ $menu->page->title }}
						    </div>
				        @endforeach
				    </div>
				    <p id="success-indicator-side" style="display:none; margin-right: 10px;">
		          		<span class="glyphicon glyphicon-ok"></span> Side Menu order has been saved
		        	</p>
			    </div>
			</div>
		</div>


		<div class="tab-pane fade" id="top_menu">
			<div class="col-md-6">
			    	<br/>
			    	<div id="all_menus">
			        	<div class="dd" id="nestable">
			          		{{ $topMenus }}
			        	</div>

			        	<p id="success-indicator-top" style="display:none; margin-right: 10px;">
			          		<span class="glyphicon glyphicon-ok"></span> Top Menu order has been saved
			        	</p>
				    </div>
			    </div>
		</div>
	</div>


	{{ HTML::script('js/icon-picker.min.js') }}

@stop

@section('style')
	{{ HTML::style('css/nestable.css') }}
	{{ HTML::style('css/icon-picker.min.css') }}
	<style type="text/css">
		#side_menus
		{
			cursor: move;
		}
		#side_menus div
		{
			background: #eee;
			padding: 10px 0px;
			text-align: center;
			border: 1px solid #fff;
		}
	</style>
@stop

@section('script')
	{{ HTML::script('js/nestable.js') }}
	{{ HTML::script('//ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.min.js') }}

	<script type="text/javascript">
		$(document).ready(function() {
			$("#side_menus").sortable(
				{
					opacity: .7,
					cursor: 'move',
					update: function() {
						var order = $(this).sortable("serialize");
						console.log(order);

						$.post("{{ URL::to('admin/build-side-menu') }}", order, function(response) {
							$("#msg").html(response);
						})
						.done(function() { 
							$( "#success-indicator-side" ).fadeIn(100).delay(1000).fadeOut();
						});
				}
			});


			$('.dd').nestable({ 
		    dropCallback: function(details) {
		       
		       var order = new Array();
		       $("li[data-id='"+details.destId +"']").find('ol:first').children().each(function(index,elem) {
		         order[index] = $(elem).attr('data-id');
		       });

		       if (order.length === 0){
		        var rootOrder = new Array();
		        $("#nestable > ol > li").each(function(index,elem) {
		          rootOrder[index] = $(elem).attr('data-id');
		        });
		       }

		       $.post('{{url("admin/build-top-menu/")}}', 
		        { source : details.sourceId, 
		          destination: details.destId, 
		          order:JSON.stringify(order),
		          rootOrder:JSON.stringify(rootOrder) 
		        }, 
		        function(data) {
		         // console.log('data '+data); 
		        })
		        .done(function() { 
		          $( "#success-indicator-top" ).fadeIn(100).delay(1000).fadeOut();
		        });
		     }
		   });
		});
	</script>
	
@stop