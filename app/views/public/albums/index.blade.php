@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>

		@include('includes.alert')

		@for($i=0; $i<count($albums); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%4 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-3">
				<div class="thumbnail text-center">
					@if(count($albums[$i]->pictures) == 0 )
						<span class="fa fa-icon fa-picture-o fa-avatar"></span>
					@else
						{{ HTML::image('uploads/album_pictures/medium_'.$albums[$i]->pictures[0]->file_url) }}
					@endif
					<div class="caption">
						<h4>{{ $albums[$i]->name}}</h4>
						<p>
							{{ count($albums[$i]->pictures) }} picture(s)
							<br/>
							<br/>
							<a class="btn btn-sm btn-primary btn-block" href="{{ URL::route('albums.show', $albums[$i]->url) }}">View this album</a>
						</p>
					</div>
				</div>
			</div>
		@endfor
		</div>
	</div>
@stop