@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
		      	<p class="text-center">{{ Helper::currentPicture($stuff) }}</p>
	        	
	        	<h4 class="text-center">{{ $stuff->full_name }} {{ $stuff->nick_name }}</h4>
	        	<p class="text-center">
	        		{{ $stuff->tagname }}<br/>
	        		{{ $stuff->designation }}<br/>
	        		{{ $stuff->email }}<br/>
	        	</p>

	        	<a href="{{ URL::route('admin.stuffs.edit', array('stuff' => $stuff->tagname)) }}" class='btn btn-success btn-block'>
					<span class="glyphicon glyphicon-edit"></span> Edit this stuff member
				</a>
			</div>

			<div class="col-md-8 border-left">
				<h3>
					{{ $title }}
					<a href="{{ URL::route('admin.stuffs') }}" class='btn btn-primary pull-right' >
						<span class="glyphicon glyphicon-chevron-left"></span> View All Stuff
					</a>
				</h3>
				<hr/>

				<div class="row">
					<div class="col-md-6">
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
		        			<dd>{{ Helper::date($stuff->date_of_birth) }}</dd>
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
					<div class="col-md-6">
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

						<hr/>
						The account was created on {{ Helper::date($stuff->created_at) }}
						<hr/>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop