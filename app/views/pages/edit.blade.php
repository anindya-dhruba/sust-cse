@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pages') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
				</a>
			</h3>
		</div>

		@include('includes.alert')

		{{ Form::open(array('route' => array('admin.pages.edit',  $page->url), 'method' => 'put')) }}

			{{ Form::hidden('pageId', $page->id) }}
	        <div class="form-group">
	          	{{ Form::label('title', 'Title *') }}
	          	{{ Form::text('title', $page->title, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>
	        
	        @if($page->can_delete)
		        <div class="form-group">
		        	{{ Form::label('url', 'Url *') }}
		        	<div class="input-group">
				      	<span class="input-group-addon"> {{ Url::route('home') }}/</span>
				      	{{ Form::text('url', $page->url, array('class' => 'form-control url')) }}
				    </div>
				    {{ Form::error($errors, 'url') }}
		        </div>
		    @endif

	        <div class="form-group">
	          	{{ Form::label('content', 'Content *') }}
	          	{{ Form::textarea('content', $page->content, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'content') }}
	        </div>


	        @if($page->can_delete)
		        <div class="form-group">
			        <div class="checkbox">
					    <label>
							{{ Form::checkbox('is_public', '1', $page->is_public) }} This Page is visible publicly
					    </label>
				  	</div>
				</div>
			@endif
	
			{{ Form::submit('Update Page', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
    			
		{{ Form::close() }}
	</div>

@stop

@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}

	<script type="text/javascript">
		$(document).ready(function() {
			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('admin.pages.generateUrl')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});
		});
	</script>
@stop