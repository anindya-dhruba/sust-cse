@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.events') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Events
				</a>
			</h3>
		</div>

		@include('includes.alert')

		{{ Form::open(array('route' => 'admin.events.add')) }}
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
			{{ Form::submit('Add Event', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
		{{ Form::close() }}
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