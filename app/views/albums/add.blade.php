@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.albums') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Albums
				</a>
			</h3>
		</div>

		@include('includes.alert')

		{{ Form::open(array('route' => 'admin.albums.add')) }}
	        <div class="form-group">
	          	{{ Form::label('name', 'Album Name *') }}
	          	{{ Form::text('name', '', array('class' => 'form-control name')) }}
	          	{{ Form::error($errors, 'name') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/albums/</span>
			      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>			        

	        <div class="form-group">
	          	{{ Form::label('details', 'Album Details *') }}
	          	{{ Form::textarea('details', '', array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'details') }}
	        </div>

	        <div class="form-group">
		        <div class="checkbox">
				    <label>
						{{ Form::checkbox('is_public', '1', true) }} This album is visible publicly
				    </label>
			  	</div>
			</div>
			{{ Form::submit('Add Album', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
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
			$('.name').on('input', function() {
				$.post("{{ URL::route('admin.albums.generateUrl')}}", { name: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>


@stop