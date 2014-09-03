@extends('layouts.default')

@section('content')
	<div class="col-md-6 col-md-offset-3">
		<div class="page-header">
			<h2>{{ $title }} - Student Account</h2>
			<hr/>
		</div>

      	{{ Form::open(array('route' => 'register')) }}
	        
	        @include('includes.alert')
			
			<div class="form-group">
	          	{{ Form::label('reg', 'Registration No *') }}
	          	{{ Form::text('reg', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'reg') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('batch', 'Batch *') }}
	          	{{ Form::select('batch', $batches, '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'batch') }}
	        </div>

		    <div class="form-group">
	          	{{ Form::label('full_name', 'Full Name *') }}
	          	{{ Form::text('full_name', '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'full_name') }}
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
      	Already have an account? <a href="{{ URL::route('login') }}" class="btn btn-success btn-xs">Login Here</a>
      	<br/>
      	<br/>

      	<div class="alert alert-warning">
      		<strong>Are you a faculty member or stuff of SUST CSE?</strong><br/>Please contact us so that we can provide you an account.
      	</div>
    </div>
@stop