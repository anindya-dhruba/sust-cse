@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		{{ Form::open(['route' => ['password.reset', $tokenData->token]]) }}
			<div class="page-header">
				<h2>{{ $title }}</h2>
				<hr/>
			</div>

			@include('includes.alert')
    		
			{{ Form::hidden('email', $tokenData->email) }}

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

			{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary btn-block']) }}
		
		{{ Form::close() }}
	</div>
@stop