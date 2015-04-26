@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>
		
		@if(count($news) == 0)
			<div class="alert alert-success">
				No News Found.
			</div>
		@endif
  		@foreach ($news as $singleNews)
			<div class="row">
				<div class="col-md-2">
					<div class="text-center date_helper">
						<div class="big">{{ date('d', strtotime($singleNews->created_at)) }}</div>
						<div class="small">{{ date('F\'y', strtotime($singleNews->created_at)) }}</div>
					</div>
				</div>
				<div class="col-md-10">
					<a href="{{ URL::route('news.show', $singleNews->url) }}">
						<h4 class="bold">{{ $singleNews->title }}</h4>
					</a>

					<p>{{ $singleNews->news }}</p>
					<a class="btn btn-success btn-sm" href="{{ URL::route('news.show', $singleNews->url) }}"> Read More</a>
				</div>
			</div>
			<hr/>
		@endforeach

		{{ $news->links() }}
    </div>
@stop