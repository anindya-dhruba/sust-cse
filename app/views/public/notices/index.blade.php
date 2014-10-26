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
		
		@if(count($notices) == 0)
			<div class="alert alert-success">
				No Notice Found.
			</div>
		@endif
  		@foreach ($notices as $notice)
			<div class="row">
				<div class="col-md-2">
					<div class="text-center date_helper">
						<div class="big">{{ date('d', strtotime($notice->created_at)) }}</div>
						<div class="small">{{ date('F', strtotime($notice->created_at)) }}</div>
					</div>
				</div>
				<div class="col-md-10">
					<a href="{{ URL::route('notices.show', $notice->url) }}">
						<h4 class="bold">{{ $notice->title }}</h4>
					</a>

					<p>{{ $notice->notice }}</p>
					<a class="btn btn-success btn-sm" href="{{ URL::route('notices.show', $notice->url) }}"> Read More</a>
				</div>
			</div>
			<hr/>
		@endforeach

		{{ $notices->links() }}
    </div>
@stop