@extends('layouts.default')

@section('content')
	<div class="col-md-4 col-md-offset-4">
		{{ Form::open(['route' => 'password.forgot']) }}
			<div class="page-header">
				<h3>{{ $title }}</h3>
			</div>

			@include('includes.alert')
			<div class="form-group">
				{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address of the account', 'autofocus' => true]) }}
	        	{{ Form::error($errors, 'email') }}
	        </div>

			{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary btn-block']) }}

		{{ Form::close() }}

		<br/>
		<p class="text-center small">
      		Remembered your password? <br/><a href="{{ URL::route('login') }}" class="btn btn-warning btn-sm">Login Here</a>
      	</p>
	</div>
@stop