@extends('layouts.default')

@section('content')
	<div class="col-md-12">
        <div class="page-header">
            <h3>
                {{ $title }}<br/>
                <small>{{ $faculty->designation }}</small>
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
        			<dd>{{ $faculty->full_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Nick Name:</dt>
        			<dd>{{ $faculty->nick_name }}</dd>
        		</dl>
        		<dl>
        			<dt>Designation:</dt>
        			<dd>{{ $faculty->designation }}</dd>
        		</dl>
        		<dl>
        			<dt>Email Address:</dt>
        			<dd><a href="mailto:{{ $faculty->email }}">{{ $faculty->email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Alternate Email:</dt>
        			<dd><a href="mailto:{{ $faculty->alt_email }}">{{ $faculty->alt_email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Date of Birth:</dt>
        			<dd>{{ $faculty->date_of_birth }}</dd>
        		</dl>
        		<dl>
        			<dt>Phone:</dt>
        			<dd>{{ $faculty->phone }}</dd>
        		</dl>
        		<dl>
        			<dt>Mobile:</dt>
        			<dd>{{ $faculty->mobile }}</dd>
        		</dl>
        		<dl>
        			<dt>Nationality:</dt>
        			<dd>{{ $faculty->nationality }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
        		<dl>
        			<dt>Tagname:</dt>
        			<dd>{{ $faculty->tagname }}</dd>
        		</dl>
        		<dl>
        			<dt>Gender:</dt>
        			<dd>{{ $faculty->gender }}</dd>
        		</dl>
        		<dl>
        			<dt>Religion:</dt>
        			<dd>{{ $faculty->religion }}</dd>
        		</dl>
				<dl>
        			<dt>Status:</dt>
        			<dd>{{ $faculty->status }}</dd>
        		</dl>
        		<dl>
        			<dt>Blood Group:</dt>
        			<dd>{{ $faculty->blood_group }} {{ $faculty->blood_type }}</dd>
        		</dl>
        		<dl>
        			<dt>Website:</dt>
        			<dd><a href="{{ $faculty->website }}" target="_blank">{{ $faculty->website }}</a></dd>
        		</dl>
				<dl>
        			<dt>Contact Room:</dt>
        			<dd>{{ $faculty->contact_room }}</dd>
        		</dl>
        		<dl>
        			<dt>Present Address:</dt>
        			<dd>{{ $faculty->present_address }}</dd>
        		</dl>
        		<dl>
        			<dt>Permanent Address:</dt>
        			<dd>{{ $faculty->permanent_address }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($faculty) }}
			      	<div class="caption">
			      		@if(Auth::id() == $faculty->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
			        		<a href="{{ URL::route('password.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-lock"></span> Edit Password</a>
		        		@endif
		        	</div>
				</div>
			</div>
			<div class="col-md-12">
				<hr/>
				<dl>
        			<dt>About:</dt>
        			<dd>{{ $faculty->about }}</dd>
        		</dl>
				<dl>
        			<dt>Academic Background:</dt>
        			<dd>{{ $faculty->academic_background }}</dd>
        		</dl>
        		<dl>
        			<dt>Professional Experience:</dt>
        			<dd>{{ $faculty->prof_exp }}</dd>
        		</dl>
        		<dl>
        			<dt>Researchs:</dt>
        			<dd>
        				
        				@foreach($faculty->researches as $research)
        					{{ $research->name }}<br/>
        				@endforeach
        			</dd>
        		</dl>
        		<dl>
        			<dt>Area of Interest:</dt>
        			<dd>{{ $faculty->interests }}</dd>
        		</dl>
        		<dl>
        			<dt>Awards &amp; Honors:</dt>
        			<dd>{{ $faculty->awards_and_honors }}</dd>
        		</dl>
        		<dl>
        			<dt>Publications:</dt>
        			<dd>{{ $faculty->publications }}</dd>
        		</dl>
        		<dl>
        			<dt>Journal Papers:</dt>
        			<dd>{{ $faculty->journal_papers }}</dd>
        		</dl>
        		<dl>
        			<dt>Conference Papers:</dt>
        			<dd>{{ $faculty->conference_papers }}</dd>
        		</dl>
			</div>
		</div>
	</div>
@stop