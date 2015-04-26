@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.slider') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View Slider Images
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-12">
				<div class="thumbnail">
					<img src="{{ URL::to('uploads/album_pictures/original_'.$picture->file_url) }}">
				</div>
			</div>
			<div class="col-md-6 col-md-offset-3 vspace">
				{{ Form::open(['route' => ['admin.slider.crop', 'id' => $picture->id]]) }}

					<div class="form-group">
			          	{{ Form::label('caption', 'Caption *') }}
			          	{{ Form::text('caption', '', array('class' => 'form-control caption')) }}
			          	{{ Form::error($errors, 'caption') }}
			        </div>

			        <div class="form-group">
				        <div class="checkbox">
						    <label>
								{{ Form::checkbox('is_active', '1', true) }} Show this image on home slider
						    </label>
					  	</div>
					</div>

					{{ Form::hidden('picture', "uploads/album_pictures/slider_$picture->file_url") }}

					<input type="hidden" id="x" name="x" />
					<input type="hidden" id="y" name="y" />
					<input type="hidden" id="w" name="w" />
					<input type="hidden" id="h" name="h" />

					{{ Form::submit('Crop & Add To Slider', array('class' => 'btn btn-primary', 'data-loading-text' => 'Cropping...', 'type' => 'button')) }}
					<a href="{{ URL::route('admin.slider') }}" class='btn btn-default'>
						Cancel
					</a>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop


@section('style')
	{{ HTML::style('css/jquery.Jcrop.css') }}
@stop

@section('script')
	{{--{{ HTML::script('js/jquery.Jcrop.min.js') }}--}}
	{{--<script type="text/javascript">--}}
		{{--jQuery(function($){--}}
			{{--$('#target').Jcrop({--}}
				{{--allowResize: true,--}}
				{{--setSelect:[10, 10, 900, 400],--}}
				{{--minSize: [1280, 890],--}}
				{{--onSelect: updateCoords--}}
			{{--});--}}

			{{--function updateCoords(c) {--}}
				{{--$('#x').val(c.x);--}}
				{{--$('#y').val(c.y);--}}
				{{--$('#w').val(c.w);--}}
				{{--$('#h').val(c.h);--}}
			{{--};--}}
		{{--});--}}
	{{--</script>--}}

@stop