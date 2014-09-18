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
						<div class="col-md-6">
							{{ Form::hidden('id', $stuff->id) }}

						    <div class="form-group">
					          	{{ Form::label('full_name', 'Full Name *') }}
					          	{{ Form::text('full_name', $stuff->full_name, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'full_name') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('nick_name', 'Nick Name') }}
					          	{{ Form::text('nick_name', $stuff->nick_name, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'nick_name') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('designation', 'Designation *') }}
					          	{{ Form::text('designation', $stuff->designation, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'designation') }}
					        </div>

							<div class="form-group">
					          	{{ Form::label('email', 'Email Address *') }}
					          	{{ Form::text('email', $stuff->email, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'email') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('alternate_email', 'Alternate Email') }}
					          	{{ Form::text('alternate_email', $stuff->alt_email, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'alternate_email') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('phone', 'Phone') }}
					          	{{ Form::text('phone', $stuff->phone, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'phone') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('mobile', 'Mobile') }}
					          	{{ Form::text('mobile', $stuff->mobile, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'mobile') }}
					        </div>
					        <div class="form-group">
					          	{{ Form::label('nationality', 'Nationality') }}
					          	{{ Form::text('nationality', $stuff->nationality, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'nationality') }}
					        </div>
					        <div class="form-group">
					          	{{ Form::label('permanent_address', 'Permanent Address') }}
					          	{{ Form::text('permanent_address', $stuff->permanent_address, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'permanent_address') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('present_address', 'Present Address') }}
					          	{{ Form::text('present_address', $stuff->present_address, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'present_address') }}
					        </div>
						</div>

				    	<div class="col-md-6">
				    		<div class="form-group">
					          	{{ Form::label('tagname', 'Tagname*') }}
					          	{{ Form::text('tagname', $stuff->tagname, array('class' => 'form-control')) }}
					          	<p class="help-block">Example: MZI, MSR</p>
					          	{{ Form::error($errors, 'tagname') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('status', 'Status *') }}
					          	{{ Form::text('status', $stuff->status, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'status') }}
					        </div>

					        <div class="form-group">
							    {{ Form::label('picture', 'Upload Picture') }}
							    {{ Form::file('picture', array('class' => 'form-control')) }}
							    <p class="help-block">Leave blank for current profile picture</p>
							    {{ Form::error($errors, 'picture') }}
							</div>

					        <div class="form-group">
					          	{{ Form::label('date_of_birth', 'Date of Birth') }}
					          	{{ Form::text('date_of_birth', $stuff->date_of_birth, array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
					          	{{ Form::error($errors, 'date_of_birth') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('gender', 'Gender') }}
					          	{{ Form::select('gender', User::$genders, $stuff->gender, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'gender') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('religion', 'Religion') }}
					          	{{ Form::text('religion', $stuff->religion, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'religion') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('blood_group', 'Blood Group') }}
					          	<div class="row">
						          	<div class="col-md-6">
						          		{{ Form::select('blood_group', User::$blood_groups, $stuff->blood_group, array('class' => 'form-control')) }}
						          		{{ Form::error($errors, 'blood_group') }}
						          	</div>
						          	<div class="col-md-6">
						          		{{ Form::select('blood_type', User::$blood_types, $stuff->blood_type, array('class' => 'form-control')) }}
						          		{{ Form::error($errors, 'blood_type') }}
						          	</div>
						        </div>
					        </div>

					        <div class="form-group">
					          	{{ Form::label('website', 'Website') }}
					          	{{ Form::text('website', $stuff->website, array('class' => 'form-control', 'placeholder' => 'http://www.example.com')) }}
					          	{{ Form::error($errors, 'website') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('contact_room', 'Contact Room No') }}
					          	{{ Form::text('contact_room', $stuff->contact_room, array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'contact_room') }}
					        </div>
					    </div>

					    <div class="col-md-12">
					    	<div class="form-group">
					          	{{ Form::label('academic_background', 'Academic Background') }}
					          	{{ Form::textarea('academic_background', $stuff->academic_background, array('class' => 'form-control summernote')) }}
					          	{{ Form::error($errors, 'academic_background') }}
					        </div>
												     
					        <div class="form-group">
					          	{{ Form::label('about', 'About') }}
					          	{{ Form::textarea('about', $stuff->about, array('class' => 'form-control summernote')) }}
					          	{{ Form::error($errors, 'about') }}
					        </div>

					        {{ Form::submit('Update Stuff Information', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
					    </div>
					</div>
			    </div>
			</div>
	    {{ Form::close() }}
	</div>
@stop

@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}
@stop