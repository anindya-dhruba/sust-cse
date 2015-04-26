@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.courses') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Courses
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
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

				<h4>Course Semeter:</h4>
				{{ $course->semester }}
				<br/>
				<br/>

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
				
				<h4>Course Details:</h4>
				{{ $course->details }}
				<br/>

				<h4>Taking By:</h4>
					@if(is_null($course->taking_by))
						None
					@else
						<a href="{{ URL::route('faculty.show', $course->taking_by->tagname) }}">
							{{ $course->taking_by->last_name }}, {{ $course->taking_by->first_name }} {{ $course->taking_by->middle_name }}, 
						</a>
					@endif
				<br/>

				
			</div>

			<div class="col-md-3">
				
				<dl>
					<dt>Course URL:</dt>
					<dd>{{ HTML::link(URL::route('courses.show', $course->url), URL::route('courses.show', $course->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($course->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($course->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.courses.edit', array('url' => $course->url)) }}" class='btn btn-success btn-block' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-edit"></span> Edit this Course
				</a>
			</div>
		</div>
	</div>
@stop