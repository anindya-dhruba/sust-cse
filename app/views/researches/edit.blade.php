@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.researches') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Research
				</a>
			</h3>
		</div>

		@include('includes.alert')
		{{ Form::open(array('route' => array('admin.researches.edit',  $research->url), 'method' => 'put')) }}
			
			{{ Form::hidden('researchId', $research->id) }}
	        <div class="form-group">
	          	{{ Form::label('name', 'Name *') }}
	          	{{ Form::text('name', $research->name, array('class' => 'form-control name')) }}
	          	{{ Form::error($errors, 'name') }}
	        </div>
	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('researches') }}/</span>
			      	{{ Form::text('url', $research->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('description', 'Description *') }}
	          	{{ Form::textarea('description', $research->description, array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'description') }}
	        </div>
        	
        	{{ Form::submit('Update Research Topic', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
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
			$('.name').on('input', function() {
				$.post("{{ URL::route('admin.researches.generateUrl')}}", { name: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});
		});
	</script>
@stop