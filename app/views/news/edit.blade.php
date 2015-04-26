@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.news') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All News
				</a>
			</h3>
		</div>
		@include('includes.alert')

		{{ Form::open(array('route' => array('admin.news.edit',  $news->url), 'method' => 'put')) }}
				
			{{ Form::hidden('newsId', $news->id) }}
	        <div class="form-group">
	          	{{ Form::label('title', 'News Title *') }}
	          	{{ Form::text('title', $news->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/news/</span>
			      	{{ Form::text('url', $news->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('news', 'News Description *') }}
	          	{{ Form::textarea('news', $news->news, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'news') }}
	        </div>

	        <div class="form-group">
		        <div class="checkbox">
				    <label>
						{{ Form::checkbox('is_public', '1', $news->is_public) }} This News is visible publicly
				    </label>
			  	</div>
			</div>
			{{ Form::submit('Update News', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

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
				$.post("{{ URL::route('admin.news.generateUrl')}}", { title: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>


@stop