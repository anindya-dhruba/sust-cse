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
					@if($student->first_name)
						<tr>
							<th>First Name</th>
							<td>{{ $student->first_name }}</td>
						</tr>
					@endif
					@if($student->middle_name)
						<tr>
							<th>Middle Name</th>
							<td>{{ $student->middle_name }}</td>
						</tr>
					@endif
					@if($student->last_name)
						<tr>
							<th>Last Name</th>
							<td>{{ $student->last_name }}</td>
						</tr>
					@endif
					@if($student->email)
						<tr>
							<th>Email Address</th>
							<td>{{ $student->email }}</td>
						</tr>
					@endif
					@if($student->alt_email)
						<tr>
							<th>Alt Email Address</th>
							<td>{{ $student->alt_email }}</td>
						</tr>
					@endif
					@if($student->fathers_name)
						<tr>
							<th>Father's Name</th>
							<td>{{ $student->fathers_name }}</td>
						</tr>
					@endif
                        @if($student->mothers_name)
                            <tr>
                                <th>Mother's Name</th>
                                <td>{{ $student->mothers_name }}</td>
                            </tr>
                        @endif
					@if($student->phone || $student->mobile)
						<tr>
							<th>Phone / Mobile</th>
							<td>{{ $student->phone }} / {{ $student->mobile }}</td>
						</tr>
					@endif
					@if($student->gender)
						<tr>
							<th>Gender</th>
							<td>{{ $student->gender }}</td>
						</tr>
					@endif
					@if($student->religion)
						<tr>
							<th>Religion</th>
							<td>{{ $student->religion }}</td>
						</tr>
					@endif
					@if($student->blood_group)
						<tr>
							<th>Blood Group</th>
							<td>{{ $student->blood_group }} {{ $student->blood_type }}</td>
						</tr>
					@endif
					@if($student->date_of_birth)
						<tr>
							<th>Date of Birth</th>
							<td>
								@if(!is_null($student->date_of_birth))
									{{ Helper::date($student->date_of_birth) }}</td>
								@endif
						</tr>
					@endif
					@if($student->place_of_birth)
						<tr>
							<th>Place of birth</th>
							<td>{{ $student->place_of_birth }}</td>
						</tr>
					@endif
					@if($student->present_address)
						<tr>
							<th>Present Address</th>
							<td>{{ $student->present_address }}</td>
						</tr>
					@endif
					@if($student->permanent_address)
						<tr>
							<th>Permanent Address</th>
							<td>{{ $student->permanent_address }}</td>
						</tr>
					@endif
					@if($student->nationality)
						<tr>
							<th>Nationality</th>
							<td>{{ $student->nationality }}</td>
						</tr>
					@endif
					@if($student->marital_status)
						<tr>
							<th>Marital Status</th>
							<td>{{ $student->marital_status }}</td>
						</tr>
					@endif
					@if($student->website)
						<tr>
							<th>Website</th>
							<td>{{ $student->website }}</td>
						</tr>
					@endif
					@if($student->current_employment)
						<tr>
							<th>Current Employment</th>
							<td>{{ $student->current_employment }}</td>
						</tr>
					@endif
				</table>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($student) }}
			      	<div class="caption">
			        	<h4>{{ $student->last_name }}, {{ $student->first_name }} {{ $student->middle_name }}</h4>
			        	<p>
			        		{{ $student->reg }}<br/>
			        		{{ $student->email }}<br/>
			        		{{ HTML::linkRoute('batches.show', $student->batch->year." - ".$student->batch->type, [$student->batch->type, $student->batch->year]) }}
			        	</p>
			        	@if(Auth::id() == $student->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
			        		<a href="{{ URL::route('password.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-lock"></span> Edit Password</a>
			        	@endif
			      	</div>
			    </div>
			</div>
			<div class="col-md-12">
				@if($student->academic_background  && $student->academic_background != '<p><br></p>')
					<h4>Academic Background:</h4>
					<p>{{ $student->academic_background }}</p>
					<br/>
				@endif

				@if($student->employment_history && $student->employment_history != '<p><br></p>')
					<h4>Employment History:</h4>
					<p>{{ $student->employment_history }}</p>
					<br/>
				@endif

				@if($student->about && $student->about != '<p><br></p>')
					<h4>About:</h4>
					<p>{{ $student->about }}</p>
					<br/>
				@endif
				
			</div>
		</div>
	</div>
@stop