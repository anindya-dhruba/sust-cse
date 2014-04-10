@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('notices') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Notices
				</a>
			</h3>
		</div>

		{{ Form::open(array('route' => array('notices.edit',  $notice->url), 'method' => 'put')) }}

			@include('includes.alert')

			{{ Form::hidden('noticeId', $notice->id) }}
	        
	        <div class="form-group">
	          	{{ Form::label('title', 'Title *') }}
	          	{{ Form::text('title', $notice->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>

	  
	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('notices') }}/</span>
			      	{{ Form::text('url', $notice->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('notice', 'Notice *') }}
	          	{{ Form::textarea('notice', $notice->notice, array('class' => 'form-control editor')) }}
	          	{{ Form::error($errors, 'content') }}
	        </div>
        	
        	{{ Form::submit('Update Notice', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('notices.slug')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});

		});
	</script>


@stop