@extends('layouts.default')

@section('content')
	<div class="col-md-6 col-md-offset-3">
		<div class="page-header">
			<h3>{{ $title }} - Student Account</h3>
		</div>

		<div class="alert alert-warning">
      		<strong>Are you a faculty member or staff of SUST CSE?</strong><br/>If yes, Please contact us so that we can create a free account for you.
      	</div>

      	{{ Form::open(array('route' => 'register')) }}
	        
	        @include('includes.alert')
			
			<div class="form-group">
	          	{{ Form::label('reg', 'Registration No *') }}
	          	{{ Form::text('reg', '', array('class' => 'form-control', 'autofocus' => true)) }}
	          	{{ Form::error($errors, 'reg') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('batch', 'Batch *') }}
	          	{{ Form::select('batch', $batches, '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'batch') }}
	        </div>

		    <div class="form-group">
	          	{{ Form::label('first_name', 'First Name *') }}
	          	{{ Form::text('first_name', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'first_name') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('middle_name', 'Middle Name') }}
	          	{{ Form::text('middle_name', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'middle_name') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('last_name', 'Last Name *') }}
	          	{{ Form::text('last_name', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'last_name') }}
	        </div>
			
			<div class="form-group">
	          	{{ Form::label('email', 'Email Address *') }}
	          	{{ Form::text('email', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'email') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('password', 'Password *') }}
	          	{{ Form::password('password', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'password') }}
	        </div>

	        {{ Form::submit('Register', array('class' => 'btn btn-primary btn-block btn-lg', 'data-loading-text' => 'Registering...', 'type' => 'button')) }}
      	
      	{{ Form::close() }}

      	<br/>
      	<p class="text-center small">
	      	Already have an account?<br/><a href="{{ URL::route('login') }}" class="btn btn-warning btn-sm">Login Here</a>
		</p>
      	
    </div>
@stop