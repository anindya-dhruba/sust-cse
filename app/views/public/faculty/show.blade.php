@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')
		<h3>
			{{ $title }}<br/>
			<small>{{ $faculty->designation }}</small>
			<a href="{{ URL::route('faculty') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Faculty
			</a>
		</h3>
		<hr/>

		<div class="row">
			<div class="col-md-4">
        		<dl>
        			<dt>Email Address:</dt>
        			<dd><a href="mailto:{{ $faculty->user->email }}">{{ $faculty->user->email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Alternate Email:</dt>
        			<dd><a href="mailto:{{ $faculty->alt_email }}">{{ $faculty->alt_email }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Website:</dt>
        			<dd><a href="{{ $faculty->website }}" target="_blank">{{ $faculty->website }}</a></dd>
        		</dl>
        		<dl>
        			<dt>Phone:</dt>
        			<dd>{{ $faculty->phone }}</dd>
        		</dl>
        		<dl>
        			<dt>Mobile:</dt>
        			<dd>{{ $faculty->mobile }}</dd>
        		</dl>
			</div>
			<div class="col-md-4">
				<dl>
        			<dt>Current Status:</dt>
        			<dd>{{ $faculty->status }}</dd>
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
				</div>
			</div>

			<div class="col-md-12">
				<hr/>
				<dl>
        			<dt>Academic Background:</dt>
        			<dd>{{ $faculty->academic_background }}</dd>
        		</dl>
        		<dl>
        			<dt>Professional Experience:</dt>
        			<dd>{{ $faculty->prof_exp }}</dd>
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
        			<dt>About:</dt>
        			<dd>{{ $faculty->about }}</dd>
        		</dl>
			</div>
		</div>
	</div>
@stop