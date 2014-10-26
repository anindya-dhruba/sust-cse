@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('albums') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> All Albums
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<h4>Details:</h4>
		{{$album->details}}

		<br/>
		<h4>Pictures:</h4>
		@if(count($pictures) == 0)
			<div class="alert alert-info">
				No picture uploaded yet.
			</div>
		@endif
		@for($i=0; $i<count($pictures); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%4 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-3">
				<div class="thumbnail text-center">
					{{ HTML::image('uploads/album_pictures/medium_'.$pictures[$i]->file_url) }}
					<div class="caption">
						<h4>{{ $pictures[$i]->caption}}</h4>
						<p>
							<a class="btn btn-sm btn-primary btn-block" href="{{ URL::route('pictures.show', [$album->url, $pictures[$i]->url]) }}">View more...</a>
						</p>
					</div>
				</div>
			</div>
		@endfor
		</div>
	</div>
@stop