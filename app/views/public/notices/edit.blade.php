@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('courses.show', $url) }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> Back to Course
				</a>
			</h3>
		</div>

		@include('includes.alert')
		{{ Form::open(array('route' => ['notices.edit', $url, $notice->url], 'method' => 'put')) }}

			{{ Form::hidden('noticeId', $notice->id) }}

	        <div class="form-group">
	          	{{ Form::label('title', 'Notice Title *') }}
	          	{{ Form::text('title', $notice->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/courses/{{$url}}/notices/</span>
			      	{{ Form::text('url', $notice->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('notice', 'Notice Description *') }}
	          	{{ Form::textarea('notice', $notice->notice, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'notice') }}
	        </div>

			{{ Form::submit('Update Notice', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

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
				$.post("{{ URL::route('notices.generateUrl')}}", { title: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>

@stop