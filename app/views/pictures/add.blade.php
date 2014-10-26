@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pictures') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pictures
				</a>
			</h3>
		</div>

		@include('includes.alert')
		{{ Form::open(array('route' => 'admin.pictures.add', 'files' => true)) }}
	        <div class="form-group">
			    {{ Form::label('picture', 'Upload Picture *') }}
			    {{ Form::file('picture', array('class' => 'form-control')) }}
			    {{ Form::error($errors, 'picture') }}
			</div>

			<div class="form-group">
	          	{{ Form::label('album', 'This picture belongs to album:') }}
	          	{{ Form::select('album', $albumOptions, '', array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'album') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('caption', 'Picture Caption *') }}
	          	{{ Form::text('caption', '', array('class' => 'form-control caption')) }}
	          	{{ Form::error($errors, 'caption') }}
	        </div>

	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('home') }}/pictures/{album_name}/pictures/</span>
			      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('details', 'Picture Details *') }}
	          	{{ Form::textarea('details', '', array('class' => 'form-control summernote')) }}
	          	{{ Form::error($errors, 'details') }}
	        </div>

	        <div class="form-group">
		        <div class="checkbox">
				    <label>
						{{ Form::checkbox('is_public', '1', true) }} This picture is visible publicly
				    </label>
			  	</div>
			</div>
			{{ Form::submit('Add Picture', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
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
			$('.caption').on('input', function() {
				$.post("{{ URL::route('admin.pictures.generateUrl')}}", { caption: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>


@stop