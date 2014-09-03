@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		{{ Form::open(['route' => 'password.forgot']) }}
			<div class="page-header">
				<h2>{{ $title }}</h2>
				<hr/>
			</div>

			@include('includes.alert')
			<div class="form-group">
				{{ Form::text('email', '', ['class' => 'form-control', 'placeholder' => 'Email Address']) }}
	        	{{ Form::error($errors, 'email') }}
	        </div>

			{{ Form::submit('Reset Password', ['class' => 'btn btn-lg btn-primary btn-block']) }}

		{{ Form::close() }}

		<br/>
      	Remembered your password? <a href="{{ URL::route('login') }}" class="btn btn-success btn-xs">Login Here</a>
      	<br/>
      	<br/>
	</div>
@stop