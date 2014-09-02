@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.stuffs.add') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Add New Stuff
			</a>
		</h3>
		<hr/>
		
		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Photo</th>
					<th>Full Name</th>
					<th>Email</th>
					<th>Mobile</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($stuffs as $stuff)
					<tr>
						<td>{{ Helper::currentPicture($stuff, 'thumbnail') }}</td>
						<td>{{ $stuff->full_name}}</td>
						<td>
							<a href="mailto:{{ $stuff->email }}">{{ $stuff->email }}</a>
						</td>
						<td>{{ $stuff->mobile }}</td>
						<td>{{ $stuff->status}}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.stuffs.show', array('tagname' => $stuff->tagname)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
		        				<a href="{{ URL::route('admin.stuffs.edit', array('tagname' => $stuff->tagname)) }}" class='btn btn-default btn-sm'>
		        					<span class="glyphicon glyphicon-edit"></span> Edit
		        				</a>
		        				<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteStuffId="{{ $stuff->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
		        			</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $stuffs->links() }}</div>
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
					Are you sure to delete this stuff?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.stuffs.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

@stop

@section('script')
	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a student
		$('.deleteBtn').click(function() {
			var deleteStuffId = $(this).attr('deleteStuffId');
			var url = "<?php echo URL::route('admin.stuffs'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteStuffId);
		});

	});
	</script>

@stop