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

		{{ Form::open(['route' => 'password.edit', 'method' => 'put']) }}
	  		<div class="form-group">
				{{ Form::label('old_password', 'Old Password *') }}
				{{ Form::password('old_password', ['class' => 'form-control', 'placeholder' => 'Old Password']) }}
				{{ Form::error($errors, 'old_password') }}
			</div>

      		<div class="form-group">
      			{{ Form::label('new_password', 'New Password *') }}
				{{ Form::password('new_password', ['class' => 'form-control', 'placeholder' => 'New Password']) }}
				{{ Form::error($errors, 'new_password') }}
			</div>

			<div class="form-group">
	  			{{ Form::label('new_password_confirmation', 'Confirm New Password *') }}
				{{ Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => 'Confirm New Password']) }}
				{{ Form::error($errors, 'new_password_confirmation') }}
			</div>

			{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary', 'data-loading-text' => 'Reseting...', 'type' => 'button']) }}

		{{ Form::close() }}
	</div>
@stop