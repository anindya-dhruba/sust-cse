@extends('layouts.default')

@section('content')
	<div class="col-md-6 col-md-offset-3">
		<div class="page-header">
			<h3>{{ $title }}</h3>
		</div>

      	{{ Form::open(array('route' => 'login')) }}
	        
	        @include('includes.alert')
	        <div class="form-group">
	          	{{ Form::label('email', 'Email Address *') }}
	          	{{ Form::text('email', '', array('class' => 'form-control', 'autofocus' => true)) }}
	          	{{ Form::error($errors, 'email') }}
	        </div>
	        <div class="form-group">
	          	{{ Form::label('password', 'Password *') }}
	          	<span class="pull-right">{{ link_to_route('password.forgot', 'Forgot password?') }}</span>
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'password') }}
	        </div>
        	
        	{{ Form::submit('Log in',array('class' => 'btn btn-primary btn-block btn-lg', 'data-loading-text' => 'Logging in...')) }}
      	
      	{{ Form::close() }}
      	<br/>
      	<p class="text-center small">
	      	Are you a student of SUST CSE &amp; don't have an account?<br/>
	      	<a href="{{ URL::route('register') }}" class="btn btn-warning btn-sm">Click here to create a free account</a>
		</p>
    </div>
@stop