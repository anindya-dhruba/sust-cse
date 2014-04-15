@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('students') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Students
				</a>
			</h3>
		</div>
		<hr/>
		
		{{ Form::open(array('route' => 'students.add', 'files' => true)) }}

			@include('includes.alert')
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
			          	{{ Form::label('reg', 'Registration No *') }}
			          	{{ Form::text('reg', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'reg') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('full_name', 'Full Name *') }}
			          	{{ Form::text('full_name', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'full_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('nick_name', 'Nick Name') }}
			          	{{ Form::text('nick_name', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'nick_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('batch', 'Batch *') }}
			          	{{ Form::select('batch', $batches, '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'batch') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('email', 'Email Address') }}
			          	{{ Form::text('email', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'email') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('fathers_name', 'Father Name') }}
			          	{{ Form::text('fathers_name', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'fathers_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('mothers_name', 'Mother Name') }}
			          	{{ Form::text('mothers_name', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'mothers_name') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('gender', 'Gender') }}
			          	{{ Form::select('gender', User::$genders, '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'gender') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('religion', 'Religion') }}
			          	{{ Form::text('religion', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'religion') }}
			        </div>
			        <div class="form-group">
			          	{{ Form::label('nationality', 'Nationality') }}
			          	{{ Form::text('nationality', 'Bangladeshi', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'nationality') }}
			        </div>
				</div>

				<div class="col-md-6">
		        	<div class="form-group">
					    {{ Form::label('picture', 'Upload Picture') }}
					    {{ Form::file('picture', array('class' => 'form-control')) }}
					    {{ Form::error($errors, 'picture') }}
					</div>
			        <div class="form-group">
			          	{{ Form::label('date_of_birth', 'Date of Birth') }}
			          	{{ Form::text('date_of_birth', '', array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
			          	{{ Form::error($errors, 'date_of_birth') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('place_of_birth', 'Place of Birth') }}
			          	{{ Form::text('place_of_birth', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'place_of_birth') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('marital_status', 'Marital Status') }}
			          	{{ Form::select('marital_status', User::$marital_statuses, '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'marital_status') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('blood_group', 'Blood Group') }}
			          	<div class="row">
				          	<div class="col-md-6">
				          		{{ Form::select('blood_group', User::$blood_groups, '', array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_group') }}
				          	</div>
				          	<div class="col-md-6">
				          		{{ Form::select('blood_type', User::$blood_types, '', array('class' => 'form-control')) }}
				          		{{ Form::error($errors, 'blood_type') }}
				          	</div>
				        </div>
			        </div>

			        <div class="form-group">
			          	{{ Form::label('home_address', 'Home Address') }}
			          	{{ Form::text('home_address', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'home_address') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('bio', 'Bio') }}
			          	{{ Form::textarea('bio', '', array('class' => 'form-control')) }}
			          	{{ Form::error($errors, 'bio') }}
			        </div>
			    </div>
			</div>

	        {{ Form::submit('Add Student', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}

	    {{ Form::close() }}
	</div>
@stop