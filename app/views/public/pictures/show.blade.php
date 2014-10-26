@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('albums.show', $albumUrl) }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> Back to Album
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-12 text-center">
				<img width="1000px" src="{{ URL::to('uploads/album_pictures/original_'.$picture->file_url) }}">
			</div>
			<div class="col-md-10 col-md-offset-1">
				<h4>Caption:</h4>
				{{ $picture->caption }}
				<br/>
				<br/>

				<h4>Album:</h4>
				{{ $picture->album->name }}
				<br/>
				<br/>

				<h4>Details:</h4>
				{{ $picture->details }}
				<br/>

				<h4>Uploaded At:</h4>
				{{ Helper::date($picture->created_at, true) }}
			</div>
		</div>
	</div>
@stop