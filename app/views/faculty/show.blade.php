@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
			      	<p class="text-center">{{ Helper::currentPicture($faculty) }}</p>
		        	
		        	<h4 class="text-center">{{ $faculty->user->full_name }} {{ $faculty->user->nick_name }}</h4>
		        	<p class="text-center">
		        		{{ $faculty->tagname }}<br/>
		        		{{ $faculty->designation }}<br/>
		        		{{ $faculty->user->email }}<br/>
		        	</p>

		        	<a href="{{ URL::route('admin.faculty.edit', array('faculty' => $faculty->tagname)) }}" class='btn btn-success btn-block'>
						<span class="glyphicon glyphicon-edit"></span> Edit this faculty member
					</a>
				</div>

			<div class="col-md-8 border-left">
				<h3>
					{{ $title }}
					<a href="{{ URL::route('admin.faculty') }}" class='btn btn-primary pull-right' >
						<span class="glyphicon glyphicon-chevron-left"></span> View All Faculty
					</a>
				</h3>
				<hr/>

				<div class="row">
					<div class="col-md-6">
						<dl>
		        			<dt>Full Name:</dt>
		        			<dd>{{ $faculty->user->full_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Nick Name:</dt>
		        			<dd>{{ $faculty->user->nick_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Designation:</dt>
		        			<dd>{{ $faculty->designation }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Email Address:</dt>
		        			<dd><a href="mailto:{{ $faculty->user->email }}">{{ $faculty->user->email }}</a></dd>
		        		</dl>
		        		<dl>
		        			<dt>Alternate Email:</dt>
		        			<dd><a href="mailto:{{ $faculty->alt_email }}">{{ $faculty->alt_email }}</a></dd>
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
					<div class="col-md-6">
		        		<dl>
		        			<dt>Tagname:</dt>
		        			<dd>{{ $faculty->tagname }}</dd>
		        		</dl>
						<dl>
		        			<dt>Status:</dt>
		        			<dd>{{ $faculty->status }}</dd>
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

						<hr/>
						The account was created on {{ Helper::date($faculty->created_at) }}
						<hr/>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop