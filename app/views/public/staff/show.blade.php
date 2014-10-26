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
				<dl>
        			<dt>Full Name:</dt>
        			<dd>{{ $staff->full_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Nick Name:</dt>
        			<dd>{{ $staff->nick_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Designation:</dt>
        			<dd>{{ $staff->designation }}</dd>
        		</dl>
        		<dl>
        			<dt>Email Address:</dt>
        			<dd><a href="mailto:{{ $staff->email }}">{{ $staff->email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Alternate Email:</dt>
        			<dd><a href="mailto:{{ $staff->alt_email }}">{{ $staff->alt_email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Date of Birth:</dt>
        			<dd>{{ $staff->date_of_birth }}</dd>
        		</dl>
        		<dl>
        			<dt>Phone:</dt>
        			<dd>{{ $staff->phone }}</dd>
        		</dl>
        		<dl>
        			<dt>Mobile:</dt>
        			<dd>{{ $staff->mobile }}</dd>
        		</dl>
        		<dl>
        			<dt>Nationality:</dt>
        			<dd>{{ $staff->nationality }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
        		<dl>
        			<dt>Tagname:</dt>
        			<dd>{{ $staff->tagname }}</dd>
        		</dl>
        		<dl>
        			<dt>Gender:</dt>
        			<dd>{{ $staff->gender }}</dd>
        		</dl>
        		<dl>
        			<dt>Religion:</dt>
        			<dd>{{ $staff->religion }}</dd>
        		</dl>
				<dl>
        			<dt>Status:</dt>
        			<dd>{{ $staff->status }}</dd>
        		</dl>
        		<dl>
        			<dt>Blood Group:</dt>
        			<dd>{{ $staff->blood_group }} {{ $staff->blood_type }}</dd>
        		</dl>
        		<dl>
        			<dt>Website:</dt>
        			<dd><a href="{{ $staff->website }}" target="_blank">{{ $staff->website }}</a></dd>
        		</dl>
				<dl>
        			<dt>Contact Room:</dt>
        			<dd>{{ $staff->contact_room }}</dd>
        		</dl>
        		<dl>
        			<dt>Present Address:</dt>
        			<dd>{{ $staff->present_address }}</dd>
        		</dl>
        		<dl>
        			<dt>Permanent Address:</dt>
        			<dd>{{ $staff->permanent_address }}</dd>
        		</dl>
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
				<dl>
        			<dt>Academic Background:</dt>
        			<dd>{{ $staff->academic_background }}</dd>
        		</dl>
				<dl>
        			<dt>About:</dt>
        			<dd>{{ $staff->about }}</dd>
        		</dl>
			</div>
		</div>
	</div>
@stop