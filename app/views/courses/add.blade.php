@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.courses') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Courses
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		<div class="row"> 
			{{ Form::open(array('route' => 'admin.courses.add')) }}
				<div class="col-md-4">
					<br/>
					<div class="alert alert-warning">
						<h4>Instructions:</h4>
						<ol>
							<li>Fields with <b>*</b> are required.</li>
							<li>Edit the form correctly.</li>
							<li>Click <b>add course</b> when you are done.</li>
						</ol>
					</div>
				</div>

				<div class="col-md-8">
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
					      	<span class="input-group-addon"> {{ Url::route('home') }}/</span>
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
			          	{{ Form::textarea('details', '', array('class' => 'form-control', 'id' => 'editor')) }}
			          	{{ Form::error($errors, 'details') }}
			        </div>
		        	
		        	{{ Form::submit('Add Course', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
		        </div>

			{{ Form::close() }}
		</div>
	</div>


	
@stop

@section('script')
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