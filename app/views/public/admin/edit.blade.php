@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		{{ Form::open(array('route' => 'profile.edit', 'files' => true, 'method' => 'put')) }}
			<div class="row">
				<div class="col-md-12">
					<h3>
						{{ $title }}
						<a href="{{ URL::route('profile.show') }}" class='btn btn-primary pull-right'>
							<span class="glyphicon glyphicon-chevron-left"></span> Profile
						</a>
					</h3>
					<hr/>
					
					@include('includes.alert')
					
					<div class="row">
						<div class="col-md-12">
							{{ Form::hidden('id', $admin->id) }}

						    <div class="form-group">
					          	{{ Form::label('full_name', 'Full Name *') }}
					          	{{ Form::text('full_name', $admin->full_name, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'full_name') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('nick_name', 'Nick Name') }}
					          	{{ Form::text('nick_name', $admin->nick_name, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'nick_name') }}
					        </div>

							<div class="form-group">
					          	{{ Form::label('email', 'Email Address *') }}
					          	{{ Form::text('email', $admin->email, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'email') }}
					        </div>

					        <div class="form-group">
							    {{ Form::label('picture', 'Upload Picture') }}
							    {{ Form::file('picture', array('class' => 'form-control')) }}
							    <p class="help-block">Leave blank for current profile picture</p>
							    {{ Form::error($errors, 'picture') }}
							</div>

					        {{ Form::submit('Update Profile Information', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
					    </div>
					</div>
			    </div>
			</div>
	    {{ Form::close() }}
	</div>


	
@stop