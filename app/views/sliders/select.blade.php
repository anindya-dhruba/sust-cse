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
			@foreach($pictures as $picture)
				<div class="col-md-3">
					<div class="thumbnail">
						{{ HTML::image(URL::to('uploads/album_pictures/medium_'.$picture->file_url)) }}
						<div class="caption text-center">
						<a href="{{ URL::route('admin.slider.crop', $picture->id) }}" class="btn btn-primary" role="button">Use in home slider</a>
						</div>
					</div>
				</div>
			@endforeach
		</div>

		<div class="text-center">{{ $pictures->links() }}</div>
	</div>
@stop