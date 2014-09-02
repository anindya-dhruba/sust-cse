@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-8">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Full Name</th>
						<td>{{ $student->full_name }}</td>
					</tr>
					<tr>
						<th>Nick Name</th>
						<td>{{ $student->nick_name }}</td>
					</tr>
					<tr>
						<th>Email Address</th>
						<td>{{ $student->email }}</td>
					</tr>
					<tr>
						<th>Alt Email Address</th>
						<td>{{ $student->alt_email }}</td>
					</tr>
					<tr>
						<th>Father's Name</th>
						<td>{{ $student->fathers_name }}</td>
					</tr>
					<tr>
						<th>Phone / Mobile</th>
						<td>{{ $student->phone }} / {{ $student->mobile }}</td>
					</tr>
					<tr>
						<th>Gender</th>
						<td>{{ $student->gender }}</td>
					</tr>
					<tr>
						<th>Religion</th>
						<td>{{ $student->religion }}</td>
					</tr>
					<tr>
						<th>Blood Group</th>
						<td>{{ $student->blood_group }} {{ $student->blood_type }}</td>
					</tr>
					<tr>
						<th>Date of Birth</th>
						<td>
							@if(!is_null($student->date_of_birth))
								{{ Helper::date($student->date_of_birth) }}</td>
							@endif
					</tr>
					<tr>
						<th>Place of birth</th>
						<td>{{ $student->place_of_birth }}</td>
					</tr>
					<tr>
						<th>Present Address</th>
						<td>{{ $student->present_address }}</td>
					</tr>
					<tr>
						<th>Permanent Address</th>
						<td>{{ $student->permanent_address }}</td>
					</tr>
					<tr>
						<th>Nationality</th>
						<td>{{ $student->nationality }}</td>
					</tr>
					<tr>
						<th>Marital Status</th>
						<td>{{ $student->marital_status }}</td>
					</tr>
					<tr>
						<th>Website</th>
						<td>{{ $student->website }}</td>
					</tr>
					<tr>
						<th>Current Employment</th>
						<td>{{ $student->current_employment }}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($student) }}
			      	<div class="caption">
			        	<h4>{{ $student->full_name }}</h4>
			        	<p>
			        		{{ $student->reg }}<br/>
			        		{{ $student->email }}<br/>
			        		{{ HTML::linkRoute('batches.show', $student->batch->year." - ".$student->batch->name." batch", $student->batch->year) }}
			        	</p>
			        	@if(Auth::id() == $student->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
			        	@endif
			      	</div>
			    </div>
			</div>
			<div class="col-md-12">
				<h4>Academic Background:</h4>
				<p>{{ $student->academic_background }}</p>				
				<br/>
				
				<h4>Employment History:</h4>
				<p>{{ $student->employment_history }}</p>
				<br/>

				<h4>About:</h4>
				<p>{{ $student->about }}</p>
				<br/>
				
			</div>
		</div>
	</div>
@stop