@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
		      	<p class="text-center">{{ Helper::currentPicture($staff) }}</p>
	        	
	        	<h4 class="text-center">{{ $staff->last_name }}, {{ $staff->first_name }} {{ $staff->middle_name }}</h4>
	        	<p class="text-center">
	        		{{ $staff->tagname }}<br/>
	        		{{ $staff->designation }}<br/>
	        		{{ $staff->email }}<br/>
	        	</p>

	        	<a href="{{ URL::route('admin.staff.edit', array('staff' => $staff->tagname)) }}" class='btn btn-success btn-block'>
					<span class="glyphicon glyphicon-edit"></span> Edit this staff member
				</a>
			</div>

			<div class="col-md-8 border-left">
				<div class="page-header">
					<h3>
						{{ $title }}
						<a href="{{ URL::route('admin.staff') }}" class='btn btn-primary pull-right' >
							<span class="glyphicon glyphicon-chevron-left"></span> View All Stuff
						</a>
					</h3>
				</div>

				<div class="row">
					<div class="col-md-6">
						<dl>
		        			<dt>First Name:</dt>
		        			<dd>{{ $staff->first_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Middle Name:</dt>
		        			<dd>{{ $staff->middle_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Last Name:</dt>
		        			<dd>{{ $staff->last_name }}</dd>
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
		        			<dd>{{ Helper::date($staff->date_of_birth) }}</dd>
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
					<div class="col-md-6">
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

						<hr/>
						The account was created on {{ Helper::date($staff->created_at) }}
						<hr/>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop