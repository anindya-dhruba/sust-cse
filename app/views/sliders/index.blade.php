@extends('layouts.admin')

@section('content')
	<div class="col-md-12">

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-12">
				<img id="target" src="{{ URL::to('uploads/album_pictures/slider_'.$picture->file_url) }}">

				{{ Form::open(['route' => 'admin.slider.crop']) }}

					{{ Form::hidden('picture', "uploads/album_pictures/slider_$picture->file_url") }}
					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />
					{{ Form::submit('Crop', ["class" => "btn btn-large btn-inverse"]) }}
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop


@section('style')
	{{ HTML::style('css/jquery.Jcrop.css') }}
@stop

@section('script')
	{{ HTML::script('js/jquery.Jcrop.min.js') }}
	<script type="text/javascript">
		jQuery(function($){
			$('#target').Jcrop({
				allowResize: false,
				setSelect:[10, 10, 900, 400],
				minSize: [900, 450],
				onSelect: updateCoords
			});

			function updateCoords(c) {
				$('#x').val(c.x);
				$('#y').val(c.y);
				$('#w').val(c.w);
				$('#h').val(c.h);
			};
		});
	</script>

@stop