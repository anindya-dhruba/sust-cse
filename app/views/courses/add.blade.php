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

		{{ Form::open(array('route' => 'admin.courses.add')) }}
			
	        <div class="form-group">
	          	{{ Form::label('title', 'Course Title *') }}
	          	{{ Form::text('title', '', array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>
			
			<div class="form-group">
	          	{{ Form::label('course_code', 'Course Code *') }}
	          	{{ Form::text('course_code', '', array('class' => 'form-control course_code')) }}
	          	{{ Form::error($errors, 'course_code') }}
	        </div>
	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('courses') }}/</span>
			      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('credit', 'Credit *') }}
	          	{{ Form::text('credit', '', array('class' => 'form-control credit')) }}
	          	{{ Form::error($errors, 'credit') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('type', 'Type *') }}
	          	{{ Form::select('type', Course::$typeOptions, '', array('class' => 'form-control type')) }}
	          	{{ Form::error($errors, 'type') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('semester', 'Semester *') }}
	          	{{ Form::select('semester', Course::$semesterOptions, '', array('class' => 'form-control semester')) }}
	          	{{ Form::error($errors, 'semester') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('prerequisite', 'Prerequisite Course *') }}
	          	{{ Form::select('prerequisite', Course::prerequisiteOptions(), '', array('class' => 'form-control prerequisite')) }}
	          	{{ Form::error($errors, 'prerequisite') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('details', 'Details') }}
	          	{{ Form::textarea('details', '', array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'details') }}
	        </div>

	        <div class="form-group">
				{{ Form::label('course_taken_by', 'Course Taken By *') }}
				{{ Form::select('course_taken_by', ['' => 'None']+User::select('id', DB::raw('CONCAT(first_name, " ", middle_name, " ", last_name) AS full_name'))->faculty()->lists('full_name', 'id'), '', array('class' => 'form-control prerequisite')) }}
				{{ Form::error($errors, 'course_taken_by') }}
			</div>
        	
        	{{ Form::submit('Add Course', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}

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