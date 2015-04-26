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
		
		{{ Form::open(array('route' => 'profile.edit', 'files' => true, 'method' => 'put')) }}
			<div class="row">
				<div class="col-md-6">
					{{ Form::hidden('id', $staff->id) }}

				    <div class="form-group">
			          	{{ Form::label('first_name', 'First Name *') }}
			          	{{ Form::text('first_name', $staff->first_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'first_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('middle_name', 'Middle Name') }}
			          	{{ Form::text('middle_name', $staff->middle_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'middle_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('last_name', 'Last Name *') }}
			          	{{ Form::text('last_name', $staff->last_name, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'last_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('designation', 'Designation *') }}
			          	{{ Form::text('designation', $staff->designation, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'designation') }}
			        </div>

					<div class="form-group">
			          	{{ Form::label('email', 'Email Address *') }}
			          	{{ Form::text('email', $staff->email, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'email') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('alternate_email', 'Alternate Email') }}
			          	{{ Form::text('alternate_email', $staff->alt_email, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'alternate_email') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('phone', 'Phone') }}
			          	{{ Form::text('phone', $staff->phone, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'phone') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('mobile', 'Mobile') }}
			          	{{ Form::text('mobile', $staff->mobile, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'mobile') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('nationality', 'Nationality') }}
			          	{{ Form::text('nationality', $staff->nationality, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'nationality') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('permanent_address', 'Permanent Address') }}
			          	{{ Form::text('permanent_address', $staff->permanent_address, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'permanent_address') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('present_address', 'Present Address') }}
			          	{{ Form::text('present_address', $staff->present_address, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'present_address') }}
			        </div>
				</div>

		    	<div class="col-md-6">
		    		<div class="form-group">
			          	{{ Form::label('tagname', 'Tagname*') }}
			          	{{ Form::text('tagname', $staff->tagname, array('class' => 'form-control')) }}
			          	<p class="help-block">Example: MZI, MSR</p>
			          	{{ Form::error($errors, 'tagname') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('status', 'Status *') }}
			          	{{ Form::text('status', $staff->status, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'status') }}
			        </div>

			        <div class="form-group">
					    {{ Form::label('picture', 'Upload Picture') }}
					    {{ Form::file('picture', array('class' => 'form-control')) }}
					    <p class="help-block">Leave blank for current profile picture</p>
					    {{ Form::error($errors, 'picture') }}
					</div>

			        <div class="form-group">
			          	{{ Form::label('date_of_birth', 'Date of Birth') }}
			          	{{ Form::text('date_of_birth', $staff->date_of_birth, array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
			          	{{ Form::error($errors, 'date_of_birth') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('gender', 'Gender') }}
			          	{{ Form::select('gender', User::$genders, $staff->gender, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'gender') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('religion', 'Religion') }}
			          	{{ Form::text('religion', $staff->religion, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'religion') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('blood_group', 'Blood Group') }}
			          	<div class="row">
				          	<div class="col-md-6">
				          		{{ Form::select('blood_group', User::$blood_groups, $staff->blood_group, array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_group') }}
				          	</div>
				          	<div class="col-md-6">
				          		{{ Form::select('blood_type', User::$blood_types, $staff->blood_type, array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_type') }}
				          	</div>
				        </div>
			        </div>

			        <div class="form-group">
			          	{{ Form::label('website', 'Website') }}
			          	{{ Form::text('website', $staff->website, array('class' => 'form-control', 'placeholder' => 'http://www.example.com')) }}
			          	{{ Form::error($errors, 'website') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('contact_room', 'Contact Room No') }}
			          	{{ Form::text('contact_room', $staff->contact_room, array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'contact_room') }}
			        </div>
			    </div>

			    <div class="col-md-12">
			    	<div class="form-group">
			          	{{ Form::label('academic_background', 'Academic Background') }}
			          	{{ Form::textarea('academic_background', $staff->academic_background, array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'academic_background') }}
			        </div>
										     
			        <div class="form-group">
			          	{{ Form::label('about', 'About') }}
			          	{{ Form::textarea('about', $staff->about, array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'about') }}
			        </div>

			        {{ Form::submit('Update Stuff Information', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
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