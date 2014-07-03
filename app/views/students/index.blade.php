@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.students.add') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Add New Student
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Photo</th>
					<th>Reg.</th>
					<th>Full Name</th>
					<th>Email Address</th>
					<th>Mobile</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td>{{ Helper::currentPicture($student, 'thumbnail') }}</td>
						<td>{{ $student->reg }}</td>
						<td>{{ $student->user->full_name}}</td>
						<td>
							<a href="mailto:{{ $student->user->email }}">{{ $student->user->email }}</a>
						</td>
						<td>{{ $student->mobile }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.students.show', array('reg' => $student->reg)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
		        				<a href="{{ URL::route('admin.students.edit', array('reg' => $student->reg)) }}" class='btn btn-default btn-sm'>
		        					<span class="glyphicon glyphicon-edit"></span> Edit
		        				</a>
		        				<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteUserId="{{ $student->user_id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
		        			</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $students->links() }}</div>
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
					Are you sure to delete this student?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.students.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
				var deleteUserId = $(this).attr('deleteUserId');
				var url = "<?php echo URL::route('admin.students'); ?>";
				$(".deleteForm").attr("action", url+'/'+deleteUserId);
			});

		});
	</script>
@stop