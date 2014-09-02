@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		{{ Form::open(array('route' => array('admin.faculty.add'), 'files' => true)) }}
			<div class="row">
				<div class="col-md-4">
					<br/>
					<div class="alert alert-warning">
						<h4>Instructions:</h4>
						<ol>
							<li>Fields with <b>*</b> are required.</li>
							<li>Edit the form correctly.</li>
							<li>Click <b>add faculty</b> when you are done.</li>
						</ol>
					</div>
				</div>
				<div class="col-md-8 border-left">
					<h3>
						{{ $title }}
						<a href="{{ URL::route('admin.faculty') }}" class='btn btn-primary pull-right'>
							<span class="glyphicon glyphicon-chevron-left"></span> View All Faculty
						</a>
					</h3>
					<hr/>
					
					@include('includes.alert')
					
					<div class="row">
						<div class="col-md-6">
						    <div class="form-group">
					          	{{ Form::label('full_name', 'Full Name *') }}
					          	{{ Form::text('full_name', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'full_name') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('nick_name', 'Nick Name') }}
					          	{{ Form::text('nick_name', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'nick_name') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('designation', 'Designation *') }}
					          	{{ Form::select('designation', User::$designations, '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'designation') }}
					        </div>

							<div class="form-group">
					          	{{ Form::label('email', 'Email Address *') }}
					          	{{ Form::text('email', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'email') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('alternate_email', 'Alternate Email') }}
					          	{{ Form::text('alternate_email', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'alternate_email') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('phone', 'Phone') }}
					          	{{ Form::text('phone', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'phone') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('mobile', 'Mobile') }}
					          	{{ Form::text('mobile', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'mobile') }}
					        </div>
					        <div class="form-group">
					          	{{ Form::label('nationality', 'Nationality') }}
					          	{{ Form::text('nationality', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'nationality') }}
					        </div>
					        <div class="form-group">
					          	{{ Form::label('permanent_address', 'Permanent Address') }}
					          	{{ Form::text('permanent_address', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'permanent_address') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('present_address', 'Present Address') }}
					          	{{ Form::text('present_address', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'present_address') }}
					        </div>
						</div>

				    	<div class="col-md-6">
				    		<div class="form-group">
					          	{{ Form::label('tagname', 'Tagname*') }}
					          	{{ Form::text('tagname', '', array('class' => 'form-control')) }}
					          	<p class="help-block">Example: MZI, MSR</p>
					          	{{ Form::error($errors, 'tagname') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('status', 'Status *') }}
					          	{{ Form::select('status', User::$statusOptions, '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'status') }}
					        </div>

					        <div class="form-group">
							    {{ Form::label('picture', 'Upload Picture') }}
							    {{ Form::file('picture', array('class' => 'form-control')) }}
							    {{ Form::error($errors, 'picture') }}
							</div>

					        <div class="form-group">
					          	{{ Form::label('date_of_birth', 'Date of Birth') }}
					          	{{ Form::text('date_of_birth', '', array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
					          	{{ Form::error($errors, 'date_of_birth') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('gender', 'Gender') }}
					          	{{ Form::select('gender', User::$genders, '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'gender') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('religion', 'Religion') }}
					          	{{ Form::text('religion', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'religion') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('blood_group', 'Blood Group') }}
					          	<div class="row">
						          	<div class="col-md-6">
						          		{{ Form::select('blood_group', User::$blood_groups, '', array('class' => 'form-control')) }}
						          		{{ Form::error($errors, 'blood_group') }}
						          	</div>
						          	<div class="col-md-6">
						          		{{ Form::select('blood_type', User::$blood_types, '', array('class' => 'form-control')) }}
						          		{{ Form::error($errors, 'blood_type') }}
						          	</div>
						        </div>
					        </div>

					        <div class="form-group">
					          	{{ Form::label('website', 'Website') }}
					          	{{ Form::text('website', '', array('class' => 'form-control', 'placeholder' => 'http://www.example.com')) }}
					          	{{ Form::error($errors, 'website') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('contact_room', 'Contact Room No') }}
					          	{{ Form::text('contact_room', '', array('class' => 'form-control')) }}
					          	{{ Form::error($errors, 'contact_room') }}
					        </div>
					    </div>

					    <div class="col-md-12">
					    	<div class="form-group">
					          	{{ Form::label('academic_background', 'Academic Background') }}
					          	{{ Form::textarea('academic_background', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'academic_background') }}
					        </div>
							
					        <div class="form-group">
					          	{{ Form::label('professional_experience', 'Professional Experience') }}
					          	{{ Form::textarea('professional_experience', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'professional_experience') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('awards_and_honors', 'Award & Honors') }}
					          	{{ Form::textarea('awards_and_honors', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'awards_and_honors') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('interests', 'Area of Interests') }}
					          	{{ Form::textarea('interests', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'interests') }}
					        </div>
							
					        <div class="form-group">
					          	{{ Form::label('about', 'About') }}
					          	{{ Form::textarea('about', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'about') }}
					        </div>

					        <div class="form-group" id="research">
					          	{{ Form::label('research', 'Research Areas') }}
					          		<div id="researchContainer">
						          		@foreach($researches as $research)
						          			<div class="checkbox">
												<label>
													{{ Form::checkbox('research[]', $research->id, false) }}
													{{ $research->name }}
												</label>
											</div>
										@endforeach
									</div>
									
									<button type="button" class="btn btn-sm btn-default" data-toggle="modal" data-target="#newResearch"><span class="fa fa-plus"></span> Add New</button>

					          	{{ Form::error($errors, 'research') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('publications', 'Publications') }}
					          	{{ Form::textarea('publications', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'publications') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('journal_papers', 'Journal Papers') }}
					          	{{ Form::textarea('journal_papers', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'journal_papers') }}
					        </div>

					        <div class="form-group">
					          	{{ Form::label('conference_papers', 'Conference Papers') }}
					          	{{ Form::textarea('conference_papers', '', array('class' => 'form-control ckeditor')) }}
					          	{{ Form::error($errors, 'conference_papers') }}
					        </div>


					        {{ Form::submit('Add Faculty', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
					    </div>
					</div>
			    </div>
			</div>
	    {{ Form::close() }}
	</div>




	<!-- Modal -->
	<div class="modal fade" id="newResearch" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
					<h4 class="modal-title" id="myModalLabel">New Research Area</h4>
				</div>
				<div class="modal-body">
					{{ Form::label('name', 'Research Area Name*') }}
					{{ Form::text('name', null, ['class' => 'form-control', 'id' => 'newResearchInput']) }}
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					{{ Form::button('Submit', ['class'=>'btn btn-success', 'id' => 'newResearchSubmit']) }}
				</div>
			</div>
		</div>
	</div>
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
			$('#newResearchSubmit').click(function(){
				$.post("{{ URL::route('admin.faculty.research.add') }}", {'name': $('#newResearchInput').val()}, function(data){
					var customData = '<div class=\'checkbox\'><label><input name="research[]" type="checkbox" value='+ data.id +' checked=true> '+data.name+'</label></div>';
	                $('#researchContainer').append(customData);
	                $('#newResearch').modal('hide');
				});
			});
		});
	</script>
@stop