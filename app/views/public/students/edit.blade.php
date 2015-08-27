@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('profile.show') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> Profile
				</a>
			</h3>
		</div>
		@include('includes.alert')
		
		{{ Form::open(array('route' => array('profile.edit'), 'files' => true, 'method' => 'put')) }}

			<div class="row">
				<div class="col-md-6">

					{{ Form::hidden('id', $student->id) }}

				    <div class="form-group">
			          	{{ Form::label('first_name', 'First Name *') }}
			          	{{ Form::text('first_name', $student->first_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'first_name') }}
			        </div>

			        <div class="form-group">
						{{ Form::label('middle_name', 'Middle Name ') }}
						{{ Form::text('middle_name', $student->middle_name, array('class' => 'form-control')) }}
						{{ Form::error($errors, 'middle_name') }}
					</div>
					<div class="form-group">
						{{ Form::label('last_name', 'Last Name *') }}
						{{ Form::text('last_name', $student->last_name, array('class' => 'form-control')) }}
						{{ Form::error($errors, 'last_name') }}
					</div>
			        <div class="form-group">
			          	{{ Form::label('fathers_name', 'Father Name') }}
			          	{{ Form::text('fathers_name', $student->fathers_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'fathers_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('mothers_name', 'Mother Name') }}
			          	{{ Form::text('mothers_name', $student->mothers_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'mothers_name') }}
			        </div>

					<div class="form-group">
			          	{{ Form::label('email', 'Email Address') }}
			          	{{ Form::text('email', $student->email, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'email') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('alternate_email', 'Alternate Email') }}
			          	{{ Form::text('alternate_email', $student->alt_email, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'alternate_email') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('phone', 'Phone') }}
			          	{{ Form::text('phone', $student->phone, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'phone') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('mobile', 'Mobile') }}
			          	{{ Form::text('mobile', $student->mobile, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'mobile') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('gender', 'Gender') }}
			          	{{ Form::select('gender', User::$genders, $student->gender, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'gender') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('website', 'Website') }}
			          	{{ Form::text('website', $student->website, array('class' => 'form-control', 'placeholder' => 'http://www.example.com')) }}
			          	{{ Form::error($errors, 'website') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('religion', 'Religion') }}
			          	{{ Form::text('religion', $student->religion, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'religion') }}
			        </div>
				</div>

		    	<div class="col-md-6">
		    		<div class="form-group">
					    {{ Form::label('picture', 'Upload Picture') }}
					    {{ Form::file('picture', array('class' => 'form-control')) }}
					    <p class="help-block">leave blank for the current profile picture</p>
					    {{ Form::error($errors, 'picture') }}
					</div>
					<div class="form-group">
			          	{{ Form::label('reg', 'Registration No *') }}
			          	{{ Form::text('reg', $student->reg, array('class' => 'form-control', 'readonly')) }}
			          	{{ Form::error($errors, 'reg') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('batch', 'Batch *') }}
			          	{{ Form::select('batch', $batches, $student->batch_id, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'batch') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('blood_group', 'Blood Group') }}
			          	<div class="row">
				          	<div class="col-md-6">
				          		{{ Form::select('blood_group', User::$blood_groups, $student->blood_group, array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_group') }}
				          	</div>
				          	<div class="col-md-6">
				          		{{ Form::select('blood_type', User::$blood_types, $student->blood_type, array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_type') }}
				          	</div>
				        </div>
			        </div>
					<div class="form-group">
			          	{{ Form::label('permanent_address', 'Permanent Address') }}
			          	{{ Form::text('permanent_address', $student->permanent_address, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'permanent_address') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('present_address', 'Present Address') }}
			          	{{ Form::text('present_address', $student->present_address, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'present_address') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('nationality', 'Nationality') }}
			          	{{ Form::text('nationality', $student->nationality, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'nationality') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('date_of_birth', 'Date of Birth') }}
			          	{{ Form::text('date_of_birth', $student->date_of_birth, array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
			          	{{ Form::error($errors, 'date_of_birth') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('place_of_birth', 'Place of Birth') }}
			          	{{ Form::text('place_of_birth', $student->place_of_birth, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'place_of_birth') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('marital_status', 'Marital Status') }}
			          	{{ Form::select('marital_status', User::$marital_statuses, $student->marital_statuses, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'marital_status') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('current_employment', 'Current Employment') }}
			          	{{ Form::text('current_employment', $student->current_employment, array('class' => 'form-control', 'placeholder' => 'if available')) }}
			          	{{ Form::error($errors, 'current_employment') }}
			        </div>
			    </div>
			    <div class="col-md-12">
			    	<div class="form-group">
			          	{{ Form::label('academic_background', 'Academic Background') }}
			          	{{ Form::textarea('academic_background', $student->academic_background, array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'academic_background') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('employment_history', 'Employment History') }}
			          	{{ Form::textarea('employment_history', $student->employment_history, array('class' => 'form-control summernote', 'placeholder' => 'if available')) }}
			          	{{ Form::error($errors, 'employment_history') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('about', 'About') }}
			          	{{ Form::textarea('about', $student->about, array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'about') }}
			        </div>

			        {{ Form::submit('Update Student', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
			    </div>
			</div>
	    {{ Form::close() }}
	</div>
@stop

@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}
@stop