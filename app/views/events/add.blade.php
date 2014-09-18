@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.events') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Events
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		<div class="row">
			{{ Form::open(array('route' => 'admin.events.add')) }}

				<div class="col-md-4">
					<br/>
					<div class="alert alert-warning">
						<h4>Instructions:</h4>
						<ol>
							<li>Fields with <b>*</b> are required.</li>
							<li>Fill the form correctly.</li>
							<li><b>Control Visibility</b> of the event by checking/unchecking the checkbox</li>
							<li>Click <b>add event</b> when you are done.</li>
						</ol>
					</div>
				</div>

				<div class="col-md-8">
			        <div class="form-group">
			          	{{ Form::label('title', 'Event Title *') }}
			          	{{ Form::text('title', '', array('class' => 'form-control title')) }}
			          	{{ Form::error($errors, 'title') }}
			        </div>

			        <div class="form-group">
			        	{{ Form::label('url', 'Url *') }}
			        	<div class="input-group">
					      	<span class="input-group-addon"> {{ Url::route('home') }}/events/</span>
					      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
					    </div>
					    {{ Form::error($errors, 'url') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('start_date', 'Event Start Date *') }}
			          	{{ Form::text('start_date', '', array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
			          	{{ Form::error($errors, 'start_date') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('end_date', 'Event End Date *') }}
			          	{{ Form::text('end_date', '', array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
			          	{{ Form::error($errors, 'end_date') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('event', 'Event Description *') }}
			          	{{ Form::textarea('event', '', array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'event') }}
			        </div>

			        <div class="form-group">
				        <div class="checkbox">
						    <label>
								{{ Form::checkbox('is_public', '1', true) }} This event is visible publicly
						    </label>
					  	</div>
					</div>
					{{ Form::submit('Add Event', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
				</div>

			{{ Form::close() }}
		</div>
	</div>
@stop

	
@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}

	<script type="text/javascript">
		$(document).ready(function() {
			// gets url
			$('.title').on('input', function() {
				$.post("{{ URL::route('admin.events.generateUrl')}}", { title: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>


@stop