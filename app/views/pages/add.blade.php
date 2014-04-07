@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('pages') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
				</a>
			</h3>
		</div>

		{{ Form::open(array('route' => 'pages.add')) }}

			@include('includes.alert')
	        <div class="form-group">
	          	{{ Form::label('title', 'Title *') }}
	          	{{ Form::text('title', '', array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'title') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('visible', 'Visibility *') }}
		        <div class="checkbox">
				    <label>
						{{ Form::checkbox('visible', '1', true) }} This Page is visible publicly and show to public menu
				    </label>
			  	</div>
			</div>
	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/</span>
			      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('content', 'Content *') }}
	          	{{ Form::textarea('content', '', array('class' => 'form-control editor')) }}
	          	{{ Form::error($errors, 'content') }}
	        </div>
        	
        	{{ Form::submit('Add Page', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>


	

	<script type="text/javascript">
		$(document).ready(function() {
			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('pages.slug')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});

		});
	</script>


@stop