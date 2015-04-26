@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.courses.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New Course
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Semester</th>
					<th>Course Code - Title</th>
					<th>Credit</th>
					<th>Type</th>
					<th>Taken By</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($courses as $course)
					<tr>
						<td>{{ $course->semester }}</td>
						<td>
							<a href="{{ URL::route('courses.show', $course->url)}}" target="_blank">
								{{ $course->course_code }} - {{ $course->title }}
							</a>
						</td>
						<td>{{ $course->credit }}</td>
						<td>{{ $course->type }}</td>
						<td>
							@if(is_null($course->taking_by))
								None
							@else
								<a href="{{ URL::route('faculty.show', $course->taking_by->tagname) }}">
									{{ $course->taking_by->last_name }}, {{ $course->taking_by->first_name }} {{ $course->taking_by->middle_name }}
								</a>
							@endif
						</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.courses.show', array('url' => $course->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.courses.edit', array('url' => $course->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{{ $course->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $courses->links() }}</div>
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
					Are you sure to delete this course?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.courses.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a page
		$('.deleteBtn').click(function() {
			var deleteId = $(this).attr('deleteId');
			var url = "<?php echo URL::route('admin.courses'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteId);
		});

	});
	</script>

@stop