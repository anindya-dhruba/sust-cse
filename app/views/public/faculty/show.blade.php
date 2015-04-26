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
				@if($faculty->first_name)
					<dl>
						<dt>First Name:</dt>
						<dd>{{ $faculty->first_name }}</dd>
					</dl>
				@endif
				@if($faculty->middle_name)
					<dl>
						<dt>Middle Name:</dt>
						<dd>{{ $faculty->middle_name }}</dd>
					</dl>
				@endif
				@if($faculty->last_name)
					<dl>
						<dt>Last Name:</dt>
						<dd>{{ $faculty->last_name }}</dd>
					</dl>
				@endif
				@if($faculty->designation)
					<dl>
						<dt>Designation:</dt>
						<dd>{{ $faculty->designation }}</dd>
					</dl>
				@endif
				@if($faculty->email)
					<dl>
						<dt>Email Address:</dt>
						<dd><a href="mailto:{{ $faculty->email }}">{{ $faculty->email }}</a></dd>
					</dl>
				@endif
				@if($faculty->alt_email)
					<dl>
						<dt>Alternate Email:</dt>
						<dd><a href="mailto:{{ $faculty->alt_email }}">{{ $faculty->alt_email }}</a></dd>
					</dl>
				@endif
				@if($faculty->date_of_birth)
					<dl>
						<dt>Date of Birth:</dt>
						<dd>{{ $faculty->date_of_birth }}</dd>
					</dl>
				@endif
				@if($faculty->phone)
					<dl>
						<dt>Phone:</dt>
						<dd>{{ $faculty->phone }}</dd>
					</dl>
				@endif
				@if($faculty->mobile)
					<dl>
						<dt>Mobile:</dt>
						<dd>{{ $faculty->mobile }}</dd>
					</dl>
				@endif
				@if($faculty->nationality)
					<dl>
						<dt>Nationality:</dt>
						<dd>{{ $faculty->nationality }}</dd>
					</dl>
				@endif
			</div>
			<div class="col-md-4">
				@if($faculty->tagname)
					<dl>
						<dt>Tagname:</dt>
						<dd>{{ $faculty->tagname }}</dd>
					</dl>
				@endif
				@if($faculty->gender)
					<dl>
						<dt>Gender:</dt>
						<dd>{{ $faculty->gender }}</dd>
					</dl>
				@endif
				@if($faculty->religion)
					<dl>
						<dt>Religion:</dt>
						<dd>{{ $faculty->religion }}</dd>
					</dl>
				@endif
				@if($faculty->status)
					<dl>
						<dt>Status:</dt>
						<dd>{{ $faculty->status }}</dd>
					</dl>
				@endif
				@if($faculty->blood_type)
					<dl>
						<dt>Blood Group:</dt>
						<dd>{{ $faculty->blood_group }} {{ $faculty->blood_type }}</dd>
					</dl>
				@endif
				@if($faculty->website)
					<dl>
						<dt>Website:</dt>
						<dd><a href="{{ $faculty->website }}" target="_blank">{{ $faculty->website }}</a></dd>
					</dl>
				@endif
				@if($faculty->contact_room)
					<dl>
						<dt>Contact Room:</dt>
						<dd>{{ $faculty->contact_room }}</dd>
					</dl>
				@endif
				@if($faculty->present_address)
					<dl>
						<dt>Present Address:</dt>
						<dd>{{ $faculty->present_address }}</dd>
					</dl>
				@endif
				@if($faculty->permanent_address)
					<dl>
						<dt>Permanent Address:</dt>
						<dd>{{ $faculty->permanent_address }}</dd>
					</dl>
				@endif
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
				@if($faculty->about)
					<dl>
						<dt>About:</dt>
						<dd>{{ $faculty->about }}</dd>
					</dl>
				@endif
				@if($faculty->academic_background)
					<dl>
						<dt>Academic Background:</dt>
						<dd>{{ $faculty->academic_background }}</dd>
					</dl>
				@endif
				@if($faculty->prof_exp)
					<dl>
						<dt>Professional Experience:</dt>
						<dd>{{ $faculty->prof_exp }}</dd>
					</dl>
				@endif
				@if(count($faculty->researches) > 0)
					<dl>
						<dt>Researchs:</dt>
						<dd>

							@foreach($faculty->researches as $research)
								<a href="{{URL::route('researches.show', $research->url) }}">{{ $research->name }}</a><br/>
							@endforeach
						</dd>
					</dl>
				@endif
				@if($faculty->interests)
					<dl>
						<dt>Area of Interest:</dt>
						<dd>{{ $faculty->interests }}</dd>
					</dl>
				@endif
				@if($faculty->awards_and_honors)
					<dl>
						<dt>Awards &amp; Honors:</dt>
						<dd>{{ $faculty->awards_and_honors }}</dd>
					</dl>
				@endif
				@if($faculty->publications)
					<dl>
						<dt>Publications:</dt>
						<dd>{{ $faculty->publications }}</dd>
					</dl>
				@endif
			</div>

			<div class="col-md-12">
				<h3>
					Offering Courses
				</h3>

				@if(count($faculty->courses_taking) == 0)
					<div class="alert alert-success">
						No course found.
					</div>
				@else

					<table class="table table-bordered table-striped table-hover">
						<tr class="success">
							<th>Course Code - Name</th>
							<th>Semester</th>
							<th>Credit</th>
							<th>Type</th>
							<th>Prerequisite Course</th>
						</tr>
						@foreach($faculty->courses_taking as $course_taking)
							<tr>
								<td>
									<a href="{{ URL::route('courses.show', $course_taking['url']) }}">
										{{ $course_taking['course_code'] }} - {{ $course_taking['title'] }}
									</a>
								</td>
								<td>{{ $course_taking['semester'] }}</td>
								<td>{{ $course_taking['credit'] }}</td>
								<td>{{ $course_taking['type'] }}</td>
								<td>
									@if(is_null($course_taking['prerequisite']))
										None
									@else
										<a href="{{ URL::route('courses.show', $course_taking['prerequisite_course']['url']) }}">
											{{ $course_taking['prerequisite_course']['course_code'] }} - {{ $course_taking['prerequisite_course']['title'] }}
										</a>
									@endif
								</td>
							</tr>
						@endforeach
					</table>
				@endif
			</div>
		</div>
	</div>
@stop