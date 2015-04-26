@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.staff.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New Stuff
				</a>
			</h3>
		</div>
		
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
				@foreach($staffCollection as $staff)
					<tr>
						<td>{{ Helper::currentPicture($staff, 'thumbnail') }}</td>
						<td>{{ $staff->last_name}}, {{ $staff->first_name}} {{ $staff->middle_name}}</td>
						<td>
							<a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a>
						</td>
						<td>{{ $staff->mobile }}</td>
						<td>{{ $staff->status}}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.staff.show', array('tagname' => $staff->tagname)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
		        				<a href="{{ URL::route('admin.staff.edit', array('tagname' => $staff->tagname)) }}" class='btn btn-default btn-sm'>
		        					<span class="glyphicon glyphicon-edit"></span> Edit
		        				</a>
		        				<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteStuffId="{{ $staff->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
		        			</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $staffCollection->links() }}</div>
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
					Are you sure to delete this staff?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.staff.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var url = "<?php echo URL::route('admin.staff'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteStuffId);
		});

	});
	</script>

@stop