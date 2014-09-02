@extends('layouts.default')

@section('content')
	<div class="col-md-5 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

		<div class="well">
	      	{{ Form::open(array('route' => 'login')) }}
		        
		        @include('includes.alert')
		        <div class="form-group">
		          	{{ Form::label('email', 'Email Address *') }}
		          	{{ Form::text('email', '', array('class' => 'form-control', 'autofocus' => true)) }}
		          	{{ Form::error($errors, 'email') }}
		        </div>
		        <div class="form-group">
		          	{{ Form::label('password', 'Password *') }}
		          	<span class="pull-right">{{ link_to_route('login', 'Forgot password?') }}</span>
		          	{{ Form::password('password', array('class' => 'form-control')) }}
		          	{{ Form::error($errors, 'password') }}
		        </div>
	        	
	        	{{ Form::submit('Log in',array('class' => 'btn btn-primary btn-block btn-lg', 'data-loading-text' => 'Logging in...')) }}
	      	
	      	{{ Form::close() }}
      	</div>

      	Don't have an account? {{ link_to_route('login', 'Register here', array(), array('class' => 'btn btn-success btn-sm')) }}
    </div>
@stop