@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('students.add') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-plus"></span> Add New Student
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Photo</th>
					<th>Reg.</th>
					<th>Full Name</th>
					<th>Email</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($students as $student)
					<tr>
						<td>{{ Picture::currentPicture($student, 'thumbnail') }}</td>
						<td>{{ $student->reg }}</td>
						<td>{{ $student->user->full_name}}</td>
						<td>{{ $student->user->email }}</td>
						
						<td>
							<a href="{{ URL::route('students.show', array('reg' => $student->reg)); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
						<td>
	        				<a href="{{ URL::route('students.edit', array('reg' => $student->reg)) }}" class='btn btn-warning btn-sm'>
	        					<span class="glyphicon glyphicon-edit"></span>
	        				</a>
	        			</td>
	        			<td>
	        				<a href="#" class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteUserId="{{ $student->user_id }}">
	        					<span class="glyphicon glyphicon-trash"></span>
	        				</a>
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
		        	{{ Form::open(array('route' => array('students.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a student
		$('.deleteBtn').click(function() {
			var deleteUserId = $(this).attr('deleteUserId');
			var url = "<?php echo URL::route('students'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteUserId);
		});

	});
	</script>

@stop