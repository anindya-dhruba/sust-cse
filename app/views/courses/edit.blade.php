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

		{{ Form::open(['route' => ['admin.courses.edit', $course->url], 'method' => 'put']) }}

			{{ Form::hidden('courseId', $course->id) }}
	        <div class="form-group">
	          	{{ Form::label('title', 'Course Title *') }}
	          	{{ Form::text('title', $course->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>
			
			<div class="form-group">
	          	{{ Form::label('course_code', 'Course Code *') }}
	          	{{ Form::text('course_code', $course->course_code, array('class' => 'form-control course_code')) }}
	          	{{ Form::error($errors, 'course_code') }}
	        </div>
	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('courses') }}/</span>
			      	{{ Form::text('url', $course->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('credit', 'Credit *') }}
	          	{{ Form::text('credit', $course->credit, array('class' => 'form-control credit')) }}
	          	{{ Form::error($errors, 'credit') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('type', 'Type *') }}
	          	{{ Form::select('type', Course::$typeOptions, $course->type, array('class' => 'form-control type')) }}
	          	{{ Form::error($errors, 'type') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('semester', 'Semester *') }}
	          	{{ Form::select('semester', Course::$semesterOptions, $course->semester, array('class' => 'form-control semester')) }}
	          	{{ Form::error($errors, 'semester') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('prerequisite', 'Prerequisite Course *') }}
	          	{{ Form::select('prerequisite', Course::prerequisiteOptions($course->id), $course->prerequisite, array('class' => 'form-control prerequisite')) }}
	          	{{ Form::error($errors, 'prerequisite') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('details', 'Details') }}
	          	{{ Form::textarea('details', $course->details, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'details') }}
	        </div>

	        <div class="form-group">
				{{ Form::label('course_taken_by', 'Course Taken By *') }}
				{{ Form::select('course_taken_by', ['' => 'None']+User::faculty()->lists('first_name', 'id'), $course->faculty_id, array('class' => 'form-control prerequisite')) }}
				{{ Form::error($errors, 'course_taken_by') }}
			</div>
        	
        	{{ Form::submit('Update Course', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>
@stop

@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}

	<script type="text/javascript">
		$(document).ready(function() {
			// gets slug/url
			$('.course_code').on('input', function() {
				$.post("{{ URL::route('admin.courses.generateUrl')}}", { course_code: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});
		});
	</script>
@stop