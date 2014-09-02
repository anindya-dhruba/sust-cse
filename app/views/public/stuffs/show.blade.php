@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}<br/>
			<small>{{ $stuff->designation }}</small>
			<a href="{{ URL::previous() }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> Go Back
			</a>
		</h3>
		<hr/>
		@include('includes.alert')

		<div class="row">
			<div class="col-md-4">
				<dl>
        			<dt>Full Name:</dt>
        			<dd>{{ $stuff->full_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Nick Name:</dt>
        			<dd>{{ $stuff->nick_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Designation:</dt>
        			<dd>{{ $stuff->designation }}</dd>
        		</dl>
        		<dl>
        			<dt>Email Address:</dt>
        			<dd><a href="mailto:{{ $stuff->email }}">{{ $stuff->email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Alternate Email:</dt>
        			<dd><a href="mailto:{{ $stuff->alt_email }}">{{ $stuff->alt_email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Date of Birth:</dt>
        			<dd>{{ $stuff->date_of_birth }}</dd>
        		</dl>
        		<dl>
        			<dt>Phone:</dt>
        			<dd>{{ $stuff->phone }}</dd>
        		</dl>
        		<dl>
        			<dt>Mobile:</dt>
        			<dd>{{ $stuff->mobile }}</dd>
        		</dl>
        		<dl>
        			<dt>Nationality:</dt>
        			<dd>{{ $stuff->nationality }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
        		<dl>
        			<dt>Tagname:</dt>
        			<dd>{{ $stuff->tagname }}</dd>
        		</dl>
        		<dl>
        			<dt>Gender:</dt>
        			<dd>{{ $stuff->gender }}</dd>
        		</dl>
        		<dl>
        			<dt>Religion:</dt>
        			<dd>{{ $stuff->religion }}</dd>
        		</dl>
				<dl>
        			<dt>Status:</dt>
        			<dd>{{ $stuff->status }}</dd>
        		</dl>
        		<dl>
        			<dt>Blood Group:</dt>
        			<dd>{{ $stuff->blood_group }} {{ $stuff->blood_type }}</dd>
        		</dl>
        		<dl>
        			<dt>Website:</dt>
        			<dd><a href="{{ $stuff->website }}" target="_blank">{{ $stuff->website }}</a></dd>
        		</dl>
				<dl>
        			<dt>Contact Room:</dt>
        			<dd>{{ $stuff->contact_room }}</dd>
        		</dl>
        		<dl>
        			<dt>Present Address:</dt>
        			<dd>{{ $stuff->present_address }}</dd>
        		</dl>
        		<dl>
        			<dt>Permanent Address:</dt>
        			<dd>{{ $stuff->permanent_address }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($stuff) }}
			      	<div class="caption">
			      		@if(Auth::id() == $stuff->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
		        		@endif
		        	</div>
				</div>
			</div>
			<div class="col-md-12">
				<hr/>
				<dl>
        			<dt>Academic Background:</dt>
        			<dd>{{ $stuff->academic_background }}</dd>
        		</dl>
				<dl>
        			<dt>About:</dt>
        			<dd>{{ $stuff->about }}</dd>
        		</dl>
			</div>
		</div>
	</div>
@stop