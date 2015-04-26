@extends('layouts.default')

@section('content')
	<div class="col-md-12">
        <div class="page-header">
    		<h3>
    			{{ $title }}
                @if($staff->designation != '')
                    <br/>
                    <small>{{ $staff->designation }}</small>
                @endif
    			<a href="{{ URL::previous() }}" class='btn btn-primary pull-right'>
    				<span class="glyphicon glyphicon-chevron-left"></span> Go Back
    			</a>
    		</h3>
        </div>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
				@if($staff->first_name)
					<dl>
						<dt>First Name:</dt>
						<dd>{{ $staff->first_name }}</dd>
					</dl>
				@endif
				@if($staff->middle_name)
					<dl>
						<dt>Middle Name:</dt>
						<dd>{{ $staff->middle_name }}</dd>
					</dl>
                @endif
				@if($staff->last_name)
					<dl>
						<dt>Last Name:</dt>
						<dd>{{ $staff->last_name }}</dd>
					</dl>
				@endif
				@if($staff->designation)
					<dl>
						<dt>Designation:</dt>
						<dd>{{ $staff->designation }}</dd>
					</dl>
				@endif
				@if($staff->email)
					<dl>
						<dt>Email Address:</dt>
						<dd><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></dd>
					</dl>
				@endif
				@if($staff->alt_email)
					<dl>
						<dt>Alternate Email:</dt>
						<dd><a href="mailto:{{ $staff->alt_email }}">{{ $staff->alt_email }}</a></dd>
					</dl>
				@endif
				@if($staff->date_of_birth)
					<dl>
						<dt>Date of Birth:</dt>
						<dd>{{ $staff->date_of_birth }}</dd>
					</dl>
				@endif
				@if($staff->phone)
					<dl>
						<dt>Phone:</dt>
						<dd>{{ $staff->phone }}</dd>
					</dl>
				@endif
				@if($staff->mobile)
					<dl>
						<dt>Mobile:</dt>
						<dd>{{ $staff->mobile }}</dd>
					</dl>
				@endif
				@if($staff->nationality)
					<dl>
						<dt>Nationality:</dt>
						<dd>{{ $staff->nationality }}</dd>
					</dl>
				@endif
			</div>
			<div class="col-md-4">
				@if($staff->tagname)
					<dl>
						<dt>Tagname:</dt>
						<dd>{{ $staff->tagname }}</dd>
					</dl>
				@endif
				@if($staff->gender)
					<dl>
						<dt>Gender:</dt>
						<dd>{{ $staff->gender }}</dd>
					</dl>
				@endif
				@if($staff->religion)
					<dl>
						<dt>Religion:</dt>
						<dd>{{ $staff->religion }}</dd>
					</dl>
				@endif
				@if($staff->status)
					<dl>
						<dt>Status:</dt>
						<dd>{{ $staff->status }}</dd>
					</dl>
				@endif
				@if($staff->blood_group)
					<dl>
						<dt>Blood Group:</dt>
						<dd>{{ $staff->blood_group }} {{ $staff->blood_type }}</dd>
					</dl>
				@endif
				@if($staff->website)
					<dl>
						<dt>Website:</dt>
						<dd><a href="{{ $staff->website }}" target="_blank">{{ $staff->website }}</a></dd>
					</dl>
				@endif
				@if($staff->contact_room)
					<dl>
						<dt>Contact Room:</dt>
						<dd>{{ $staff->contact_room }}</dd>
					</dl>
				@endif
				@if($staff->present_address)
					<dl>
						<dt>Present Address:</dt>
						<dd>{{ $staff->present_address }}</dd>
					</dl>
				@endif
				@if($staff->permanent_address)
					<dl>
						<dt>Permanent Address:</dt>
						<dd>{{ $staff->permanent_address }}</dd>
					</dl>
				@endif
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($staff) }}
			      	<div class="caption">
			      		@if(Auth::id() == $staff->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
			        		<a href="{{ URL::route('password.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-lock"></span> Edit Password</a>
		        		@endif
		        	</div>
				</div>
			</div>
			<div class="col-md-12">
				<hr/>

				@if($staff->academic_background && $staff->academic_background != '<p><br></p>')
					<dl>
						<dt>Academic Background:</dt>
						<dd>{{ $staff->academic_background }}</dd>
					</dl>
				@endif
        		@if($staff->about && $staff->about != '<p><br></p>')
					<dl>
						<dt>About:</dt>
						<dd>{{ $staff->about }}</dd>
					</dl>
				@endif
			</div>
		</div>
	</div>
@stop