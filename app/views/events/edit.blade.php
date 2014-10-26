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
		{{ Form::open(array('route' => array('admin.events.edit',  $event->url), 'method' => 'put')) }}

			{{ Form::hidden('eventId', $event->id) }}
	        <div class="form-group">
	          	{{ Form::label('title', 'Event Title *') }}
	          	{{ Form::text('title', $event->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/events/</span>
			      	{{ Form::text('url', $event->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('start_date', 'Event Start Date *') }}
	          	{{ Form::text('start_date', $event->start_date, array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
	          	{{ Form::error($errors, 'start_date') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('end_date', 'Event End Date *') }}
	          	{{ Form::text('end_date', $event->end_date, array('class' => 'form-control', 'datepicker',  'autocomplete' => 'off')) }}
	          	{{ Form::error($errors, 'end_date') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('event', 'Event Description *') }}
	          	{{ Form::textarea('event', $event->event, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'event') }}
	        </div>

	        <div class="form-group">
		        <div class="checkbox">
				    <label>
						{{ Form::checkbox('is_public', '1', $event->is_public) }} This event is visible publicly
				    </label>
			  	</div>
			</div>
			{{ Form::submit('Update event', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
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