@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.slider') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View Slider Images
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-3">
				<img id="target" src="{{ URL::to('uploads/slider_images/thumbnail_'.$picture->file_url) }}">
			</div>
			<div class="col-md-6">
				{{ Form::open(['route' => ['admin.slider.edit', $picture->id], 'method' => 'put']) }}

					<div class="form-group">
			          	{{ Form::label('caption', 'Caption *') }}
			          	{{ Form::text('caption', $picture->caption, array('class' => 'form-control caption')) }}
			          	{{ Form::error($errors, 'caption') }}
			        </div>

			        <div class="form-group">
				        <div class="checkbox">
						    <label>
								{{ Form::checkbox('is_active', '1', $picture->is_active) }} Show this image on home slider
						    </label>
					  	</div>
					</div>

					{{ Form::submit('Update Picture Information', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
					<a href="{{ URL::route('admin.slider') }}" class='btn btn-default'>
						Cancel
					</a>
				{{ Form::close() }}
			</div>
		</div>
	</div>
@stop