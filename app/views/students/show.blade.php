@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.students') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Students
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($student) }}
			      	<div class="caption">
			        	<h4>{{ $student->user->full_name }}</h4>
			        	<p>
			        		{{ $student->reg }}<br/>
			        		{{ $student->user->email }}<br/>
			        		{{ HTML::linkRoute('admin.batches.show', $student->batch->year." - ".$student->batch->name." batch", $student->batch->year) }}
			        	</p>
			      	</div>
				    <a href="{{ URL::route('admin.students.edit', array('reg' => $student->reg)) }}" class='btn btn-warning btn-sm' style="vertical-align: middle;">
						<span class="glyphicon glyphicon-edit"></span> Edit this student
					</a>
			    </div>
			</div>
			<div class="col-md-8">
				<div class="panel-group" id="student_info">
				  	<!-- personal -->
				  	<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#personal">
				          			Personal Information
				        		</a>
							</h4>
						</div>
				    	<div id="personal" class="panel-collapse collapse in">
							<div class="panel-body">
								<table class="table table-bordered table-striped">
									<tr>
										<th>Full Name</th>
										<td>{{ $student->user->full_name }}</td>
									</tr>
									<tr>
										<th>Nick Name</th>
										<td>{{ $student->user->nick_name }}</td>
									</tr>
									<tr>
										<th>Email Address</th>
										<td>{{ $student->user->email }}</td>
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
												{{ date('d F, Y', strtotime($student->date_of_birth)) }}</td>
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
										<th style="min-width: 180px;">About</th>
										<td style="text-align: left;">
											{{ nl2br($student->about) }}
										</td>
									</tr>
								</table>
							</div>
						</div>
				  	</div>
				  	<!-- education -->
					<div class="panel panel-default">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#student_info" href="#education">
				          			Educational Background
				        		</a>
							</h4>
						</div>
				    	<div id="education" class="panel-collapse collapse">
							<div class="panel-body">
								<table class="table table-bordered table-striped">
									<tr>
										<th>College Name</th>
										<td>{{ $student->clg_name }}</td>
									</tr>
									<tr>
										<th>College Exam Name</th>
										<td>{{ $student->clg_exam_name }}</td>
									</tr>
									<tr>
										<th>College Passing Year</th>
										<td>{{ $student->clg_passing_year }}</td>
									</tr>
									<tr>
										<th>College Board Name</th>
										<td>{{ $student->clg_board_name }}</td>
									</tr>
									<tr>
										<th>College Result</th>
										<td>{{ $student->clg_result }}</td>
									</tr>
									<tr>
										<th>School Name</th>
										<td>{{ $student->scl_name }}</td>
									</tr>
									<tr>
										<th>School Exam Name</th>
										<td>{{ $student->scl_exam_name }}</td>
									</tr>
									<tr>
										<th>School Passing Year</th>
										<td>{{ $student->scl_passing_year }}</td>
									</tr>
									<tr>
										<th>School Board Name</th>
										<td>{{ $student->scl_board_name }}</td>
									</tr>
									<tr>
										<th>School Result</th>
										<td>{{ $student->scl_result }}</td>
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
								<table class="table table-bordered table-stripped">
									<tr>
										<th>Current Employment</th>
										<td>{{ $student->current_employment }}</td>
									</tr>
									<tr>
										<th>Employment History</th>
										<td style="text-align: left;">{{ nl2br($student->employment_history) }}</td>
									</tr>
									<tr>
										<th style="min-width: 180px;">Thesis On</th>
										<td style="text-align: left;">{{ nl2br($student->thesis) }}</td>
									</tr>
								</table>

								The account was created on {{ date('d F, Y', strtotime($student->created_at))}}
							</div>
						</div>
				  	</div>
				</div>
			</div>
		</div>
	</div>
@stop