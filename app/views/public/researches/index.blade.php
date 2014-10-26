@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>Research Areas</h3>
		</div>
		<div class="list-group">
			@foreach($researches as $research)
				<a href="{{ URL::route('researches.show', $research->url) }}" class="list-group-item">
					<h4 class="list-group-item-heading">
						{{ $research->name }}
					</h4>
					<p class="list-group-item-text">
						{{ $research->users->count() }} members researched on this topic.
					</p>
				</a>
			@endforeach
		</div>
    </div>
@stop