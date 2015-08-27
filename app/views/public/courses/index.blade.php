@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>{{$title}}</h3>
		</div>
		@if(count($allCourses) == 0)
			<div class="alert alert-success">
				No Courses Found.
			</div>
		@endif

        {{--<h2>Under Development</h2>--}}
  		@foreach ($allCourses as $semester => $courses)
  			<h3 class="text-center">{{ $semester }}</h3>
	  		<table class="table table-bordered table-striped table-hover">
				<tr class="success">
					<th>Course Code - Name</th>
					<th>Credit</th>
					<th>Type</th>
					<th>Prerequisite Course</th>
					<th>Taken by</th>
				</tr>
  				@foreach($courses as $course)
					<tr>
						<td>
							<a href="{{ URL::route('courses.show', $course['url']) }}">
								{{ $course['course_code'] }} - {{ $course['title'] }}
							</a>
						</td>
						<td>{{ $course['credit'] }}</td>
						<td>{{ $course['type'] }}</td>
						<td>
							@if(is_null($course['prerequisite']))
								None
							@else
								<a href="{{ URL::route('courses.show', $course['prerequisite_course']['url']) }}">
									{{ $course['prerequisite_course']['course_code'] }} - {{ $course['prerequisite_course']['title'] }}
								</a>
							@endif
						</td>
						<td>
							@if(is_null($course['taking_by']))
								None
							@else
								<a href="{{ URL::route('faculty.show', $course['taking_by']['tagname']) }}">
									{{ $course['taking_by']['last_name'] }}, {{ $course['taking_by']['first_name'] }} {{ $course['taking_by']['middle_name'] }}
								</a>
							@endif
						</td>
					</tr>
				@endforeach
			</table>
		@endforeach
    </div>
@stop