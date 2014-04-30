@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.students') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Students
				</a>
			</h3>
		</div>
		
		{{ Form::open(array('route' => array('admin.students.edit', $student->reg), 'files' => true, 'method' => 'put')) }}

			@include('includes.alert')
			<div class="row">
				<div class="col-md-6">
					<!-- personal information -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Personal Information</legend>
					    
					    {{ Form::hidden('studentId', $student->user_id) }}
					    <div class="form-group">
				          	{{ Form::label('full_name', 'Full Name *') }}
				          	{{ Form::text('full_name', $student->user->full_name, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'full_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('nick_name', 'Nick Name') }}
				          	{{ Form::text('nick_name', $student->user->nick_name, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'nick_name') }}
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
				          	{{ Form::text('email', $student->user->email, array('class' => 'form-control')) }}
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
				          	{{ Form::select('marital_status', User::$marital_statuses, $student->marital_status, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'marital_status') }}
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
				          	{{ Form::label('religion', 'Religion') }}
				          	{{ Form::text('religion', $student->religion, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'religion') }}
				        </div>
				        <div class="form-group">
				          	{{ Form::label('nationality', 'Nationality') }}
				          	{{ Form::text('nationality', $student->nationality, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'nationality') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('about', 'About') }}
				          	{{ Form::textarea('about', $student->about, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'about') }}
				        </div>
					</fieldset>

					<!-- Upload Picture -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Upload Picture</legend>

						<div class="form-group">
						    {{ Form::label('picture', 'Upload Picture') }}
						    {{ Form::file('picture', array('class' => 'form-control')) }}
						    {{ Form::error($errors, 'picture') }}
						</div>
					</fieldset>
			    </div>
			    <div class="col-md-6">
					<!-- academic information -->	    	
			    	<fieldset class="scheduler-border">
						<legend class="scheduler-border">Academic Information</legend>
						
						<div class="form-group">
				          	{{ Form::label('reg', 'Registration No *') }}
				          	{{ Form::text('reg', $student->reg, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'reg') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('batch', 'Batch *') }}
				          	{{ Form::select('batch', $batches, $student->batch_id, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'batch') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('thesis', 'Thesis') }}
				          	{{ Form::textarea('thesis', $student->thesis, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'thesis') }}
				        </div>
					</fieldset>

					<!-- information about college-->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Information About College</legend>
					    
					    <div class="form-group">
				          	{{ Form::label('college_name', 'College Name') }}
				          	{{ Form::text('college_name', $student->clg_name, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'college_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('college_exam_name', 'College Exam Name') }}
				          	{{ Form::text('college_exam_name', $student->clg_exam_name, array('class' => 'form-control', 'placeholder' => 'HSC/Alim/A Level')) }}
				          	{{ Form::error($errors, 'college_exam_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('college_passing_year', 'College Passing Year') }}
				          	{{ Form::text('college_passing_year', $student->clg_passing_year, array('class' => 'form-control', 'placeholder' => '2010')) }}
				          	{{ Form::error($errors, 'college_passing_year') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('college_board_name', 'College Board Name') }}
				          	{{ Form::text('college_board_name', $student->clg_board_name, array('class' => 'form-control', 'placeholder' => 'Dhaka')) }}
				          	{{ Form::error($errors, 'college_board_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('college_result', 'College Result') }}
				          	{{ Form::text('college_result', $student->clg_result, array('class' => 'form-control', 'placeholder' => 'GPA 5.00')) }}
				          	{{ Form::error($errors, 'college_result') }}
				        </div>
					</fieldset>

					<!-- information about school-->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Information About School</legend>
					    
						<div class="form-group">
				          	{{ Form::label('school_name', 'School Name') }}
				          	{{ Form::text('school_name', $student->scl_name, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'school_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('school_exam_name', 'School Exam Name') }}
				          	{{ Form::text('school_exam_name', $student->scl_exam_name, array('class' => 'form-control', 'placeholder' => 'SSC/Dakhil/O Level')) }}
				          	{{ Form::error($errors, 'school_exam_name') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('school_passing_year', 'School Passing Year') }}
				          	{{ Form::text('school_passing_year', $student->scl_passing_year, array('class' => 'form-control', 'placeholder' => '2008')) }}
				          	{{ Form::error($errors, 'school_passing_year') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('school_board_name', 'School Board Name') }}
				          	{{ Form::text('school_board_name', $student->scl_board_name, array('class' => 'form-control', 'placeholder' => 'Sylhet')) }}
				          	{{ Form::error($errors, 'school_board_name') }}
				        </div>

						<div class="form-group">
				          	{{ Form::label('school_result', 'School Result') }}
				          	{{ Form::text('school_result', $student->scl_result, array('class' => 'form-control', 'placeholder' => 'GPA 4.88')) }}
				          	{{ Form::error($errors, 'college_result') }}
				        </div>
					</fieldset>

					<!-- Other -->
					<!-- Other information -->
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Other Information</legend>

						<div class="form-group">
				          	{{ Form::label('current_employment', 'Current Employment') }}
				          	{{ Form::text('current_employment', $student->current_employment, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'current_employment') }}
				        </div>

				        <div class="form-group">
				          	{{ Form::label('employment_history', 'Employment History') }}
				          	{{ Form::textarea('employment_history', $student->employment_history, array('class' => 'form-control')) }}
				          	{{ Form::error($errors, 'employment_history') }}
				        </div>
					</fieldset>

			    </div>
			</div>

	        {{ Form::submit('Update Student', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

	    {{ Form::close() }}
	</div>
@stop