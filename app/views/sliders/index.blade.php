@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.slider.select') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Select New Slider Picture
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		@if(count($sliders) == 0)
			<div class="alert alert-info">
				No picture is added on slider yet.
			</div>
		@else
			<table class="table table-responsive table-bordered table-striped">
				<thead>
					<tr>
						<th>Picture</th>
						<th>Active?</th>
						<th>Caption</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sliders as $slider)
						<tr>
							<td>{{ HTML::image(URL::to("uploads/slider_images/thumbnail_{$slider->file_url}"))  }}</td>
							<td>
								@if($slider->is_active)
									<span class="glyphicon glyphicon-ok text-success"></span>
								@else
									<span class="glyphicon glyphicon-remove text-danger"></span>
								@endif
							</td>
							<td>
								{{ $slider->caption }}
							</td>
							<td>
								<div class="btn-group">
									<a href="{{ URL::route('admin.slider.edit', array('id' => $slider->id)) }}" class='btn btn-default btn-sm'>
		        						<span class="glyphicon glyphicon-edit"></span> Edit
		        					</a>
		        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteSliderPicId="{{ $slider->id }}">
			        					<span class="glyphicon glyphicon-trash"></span> Delete
			        				</a>
		        				</div>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>

	<!-- Modal -->
	<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
		      	</div>
		      	<div class="modal-body">
					Are you sure to delete this slider picture?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.slider.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a slider picture
		$('.deleteBtn').click(function() {
			var deleteSliderPicId = $(this).attr('deleteSliderPicId');
			var url = "<?php echo URL::route('admin.slider'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteSliderPicId);
		});

	});
	</script>

@stop