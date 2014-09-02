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
		</div>		
    </div>
@stop