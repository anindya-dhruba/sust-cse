@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('students') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Students
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-8">
				<div class="panel-group" id="student_info">
					<!-- academic -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#academic">
				          			Academic Information
				        		</a>
							</h4>
						</div>
				    	<div id="academic" class="panel-collapse collapse in">
							<div class="panel-body">
								<h4>Full Name:</h4>
								{{ $student->user->full_name }}
								<h4>Registration No:</h4>
								{{ $student->reg }}
								<h4>Email Address:</h4>
								{{ $student->user->email }}
								<h4>Batch:</h4>
								{{ HTML::linkRoute('batches.show', $student->batch->year." - ".$student->batch->name." batch", $student->batch->year) }}
							</div>
						</div>
				  	</div>
				  	<!-- personal -->
				  	<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#personal">
				          			Personal Information
				        		</a>
							</h4>
						</div>
				    	<div id="personal" class="panel-collapse collapse">
							<div class="panel-body">
								<table class="table table-bordered table-striped">
									<tr>
										<th>Full Name:</th>
										<td>{{ $student->user->full_name }}</td>
									</tr>
									<tr>
										<th>Nick Name:</th>
										<td>{{ $student->user->nick_name }}</td>
									</tr>
									<tr>
										<th>Father's Name:</th>
										<td>{{ $student->fathers_name }}</td>
									</tr>
									<tr>
										<th>Mother's Name:</th>
										<td>{{ $student->mothers_name }}</td>
									</tr>
									<tr>
										<th>Gender:</th>
										<td>{{ $student->gender }}</td>
									</tr>
									<tr>
										<th>Religion:</th>
										<td>{{ $student->religion }}</td>
									</tr>
									<tr>
										<th>Nationality:</th>
										<td>{{ $student->nationality }}</td>
									</tr>
									<tr>
										<th>Date of Birth:</th>
										<td>{{ date('d F, Y', strtotime($student->date_of_birth)) }}</td>
									</tr>
									<tr>
										<th>Place of birth:</th>
										<td>{{ $student->place_of_birth }}</td>
									</tr>
									<tr>
										<th>Marital Status:</th>
										<td>{{ $student->marital_status }}</td>
									</tr>
									<tr>
										<th>Blood Group:</th>
										<td>{{ $student->blood_group }} {{ $student->blood_type }}</td>
									</tr>
									<tr>
										<th>Home Address:</th>
										<td>{{ $student->home_address }}</td>
									</tr>
									<tr>
										<th style="min-width: 180px;">Bio:</th>
										<td style="text-align: left;">
											{{ nl2br($student->bio) }}
										</td>
									</tr>
								</table>
							</div>
						</div>
				  	</div>
				  	<!-- other -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#other">
				          			Other Information
				        		</a>
							</h4>
						</div>
				    	<div id="other" class="panel-collapse collapse">
							<div class="panel-body">
								The account was created on {{ date('d F, Y', strtotime($student->created_at))}}
							</div>
						</div>
				  	</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Picture::currentPicture($student) }}
			    </div>
			    <a href="{{ URL::route('students.edit', array('reg' => $student->reg)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-edit"></span> Edit this student
				</a>
				
			</div>
		</div>
	</div>
@stop