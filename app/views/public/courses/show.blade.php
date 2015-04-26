@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $course->title }}
				<a href="{{ URL::route('courses') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<div class="row">
			<div class="col-md-6">
				<h4>Course Code:</h4>
				{{ $course->course_code }}
				<br/>
				<br/>

				<h4>Course Title:</h4>
				{{ $course->title }}
				<br/>
				<br/>

				<h4>Course Credit:</h4>
				{{ $course->credit }}
				<br/>
				<br/>

				<h4>Taking By:</h4>
					@if(is_null($course['taking_by']))
						None
					@else
						<a href="{{ URL::route('faculty.show', $course['taking_by']['tagname']) }}">
							{{ $course['taking_by']['last_name'] }}, {{ $course['taking_by']['first_name'] }} {{ $course['taking_by']['middle_name'] }}
						</a>
					@endif
				<br/>
				<br/>
			</div>
			<div class="col-md-6">
				<h4>Prerequisite Course:</h4>
				@if(is_null($course->prerequisite))
					None
				@else
					{{ $course->prerequisiteCourse->course_code }} - {{ $course->prerequisiteCourse->title }}
				@endif
				<br/>
				<br/>

				<h4>Course Type:</h4>
				{{ $course->type }}
				<br/>
				<br/>
				
				<h4>Course Semeter:</h4>
				{{ $course->semester }}
				<br/>
				<br/>
			</div>
			<div class="col-md-12">
				<h4>Course Details:</h4>
				{{ $course->details }}
				<br/>
				<br/>
			</div>

			@if($course->faculty_id)
				<div class="col-md-12">
					<div class="page-header">
						<h4>
							Notices From Course Teacher {{ $course->taking_by->last_name  }}, {{ $course->taking_by->first_name  }} {{ $course->taking_by->middle_name  }}

							@if(Auth::id() == $course->taking_by->id)
								<a href="{{ URL::route('notices.add', $course->url) }}" class='btn btn-primary btn-sm pull-right'>
									<span class="glyphicon glyphicon-plus"></span> Add New Notice
								</a>
							@endif
						</h4>
					</div>

					@if(count($notices) == 0)
						<div class="alert alert-success">
							No Notice Found.
						</div>
					@endif
					@foreach ($notices as $notice)
						<div class="row">
							<div class="col-md-2">
								<div class="text-center date_helper">
									<div class="big">{{ date('d', strtotime($notice->created_at)) }}</div>
									<div class="small">{{ date('F\'y', strtotime($notice->created_at)) }}</div>
								</div>
							</div>
							<div class="col-md-10">
								<a href="{{ URL::route('notices.show', [$course->url, $notice->url]) }}">
									<h4 class="bold">{{ $notice->title }}</h4>
								</a>

								<p>{{ $notice->notice }}</p>
								<a class="btn btn-success btn-sm" href="{{ URL::route('notices.show', $notice->url) }}"> Read More</a>
								@if(Auth::id() == $course->taking_by->id)
									<a class="btn btn-success btn-sm deleteBtn" href="{{ URL::route('notices.edit', [$course->url, $notice->url]) }}"> Edit</a>
									<a class="btn btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteNoticeId="{{ $notice->id }}"> Delete</a>
								@endif
							</div>
						</div>
						<hr/>
					@endforeach

					<div class="text-center">{{ $notices->links() }}</div>

				</div>
			@endif
		</div>		
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
					Are you sure to delete this batch?
				</div>
				<div class="modal-footer">
					{{ Form::open(array('route' => array('admin.batches.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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

			// delete a notice
			$('.deleteBtn').click(function() {
				var deleteNoticeId = $(this).attr('deleteNoticeId');
				var url = "<?php echo URL::route('notices.show', $course->url); ?>";
				$(".deleteForm").attr("action", url+'/'+deleteNoticeId);
			});

		});
	</script>
@endsection