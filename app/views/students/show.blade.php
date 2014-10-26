@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
		      	<p class="text-center">{{ Helper::currentPicture($student) }}</p>
	        	
	        	<h4 class="text-center">{{ $student->full_name }} {{ $student->nick_name }}</h4>
	        	<p class="text-center">
	        		{{ $student->reg }}<br/>
	        		{{ $student->email }}<br/>
	        		{{ HTML::linkRoute('batches.show', $student->batch->year." - ".$student->batch->name." batch", $student->batch->year) }}
	        	</p>

	        	<a href="{{ URL::route('admin.students.edit', array('reg' => $student->reg)) }}" class='btn btn-success btn-block' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-edit"></span> Edit this student
				</a>
			</div>
			<div class="col-md-8 border-left">
				<div class="page-header">
					<h3>
						{{ $title }}
						<a href="{{ URL::route('admin.students') }}" class='btn btn-primary pull-right' >
							<span class="glyphicon glyphicon-chevron-left"></span> View All Students
						</a>
					</h3>
				</div>

				<div class="row">
					<div class="col-md-6">
						<dl>
		        			<dt>Full Name:</dt>
		        			<dd>{{ $student->full_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Nick Name:</dt>
		        			<dd>{{ $student->nick_name }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Registration No:</dt>
		        			<dd>{{ $student->reg }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Batch:</dt>
		        			<dd>{{ HTML::linkRoute('admin.batches.show', $student->batch->year." - ".$student->batch->name." batch", $student->batch->year) }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Email Address:</dt>
		        			<dd><a href="mailto:{{ $student->email }}">{{ $student->email }}</a></dd>
		        		</dl>
		        		<dl>
		        			<dt>Alternate Email:</dt>
		        			<dd><a href="mailto:{{ $student->alt_email }}">{{ $student->alt_email }}</a></dd>
		        		</dl>
		        		<dl>
		        			<dt>Gender:</dt>
		        			<dd>{{ $student->gender }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Phone:</dt>
		        			<dd>{{ $student->phone }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Mobile:</dt>
		        			<dd>{{ $student->mobile }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Website:</dt>
		        			<dd><a href="{{ $student->website }}" target="_blank">{{ $student->website }}</a></dd>
		        		</dl>
					</div>
					<div class="col-md-6">
						<dl>
		        			<dt>Father's Name:</dt>
							<dd>{{ $student->fathers_name }}</dd>
						</dl>
						<dl>
							<dt>Mother's Name:</dt>
							<dd>{{ $student->mothers_name }}</dd>
						</dl>
	        			<dl>
		        			<dt>Religion:</dt>
		        			<dd>{{ $student->religion }}</dd>
		        		</dl>
	        			<dl>
		        			<dt>Blood Group:</dt>
		        			<dd>{{ $student->blood_group }} {{ $student->blood_type }}</dd>
		        		</dl>
	        			<dl>
		        			<dt>Date of Birth:</dt>
		        			<dd>{{ Helper::date($student->date_of_birth) }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Place of Birth:</dt>
		        			<dd>{{ $student->place_of_birth }}</dd>
		        		</dl>
	        			<dl>
		        			<dt>Nationality:</dt>
		        			<dd>{{ $student->nationality }}</dd>
		        		</dl>
	        			<dl>
		        			<dt>Marital Status:</dt>
		        			<dd>{{ $student->marital_status }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Present Address:</dt>
		        			<dd>{{ $student->present_address }}</dd>
		        		</dl>
		        		<dl>
		        			<dt>Permanent Address:</dt>
		        			<dd>{{ $student->permanent_address }}</dd>
		        		</dl>
						<dl>
							<dt>Current Employment:</dt>
							<dd>{{ $student->current_employment }}</dd>
						</dl>
		        	</div>
		        	<div class="col-md-12">
		        		<dl>
							<dt>Academic Background:</dt>
							<dd>{{ $student->academic_background }}</dd>
						</dl>
						<dl>
							<dt>Employment History:</dt>
							<dd>{{ $student->employment_history }}</dd>
						</dl>
						<dl>
							<dt>About:</dt>
							<dd>{{ $student->about }}</dd>
						</dl>
					</div>

					<div class="col-md-12">
						<hr/>
						The account was created on {{ Helper::date($student->created_at) }}
						<hr/>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop