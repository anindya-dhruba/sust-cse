@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>{{$title}}</h3>
		</div>
		
		@if(count($events) == 0)
			<div class="alert alert-success">
				No Event Found.
			</div>
		@endif
  		@foreach ($events as $event)
			<div class="row">
				<div class="col-md-2">
					<div class="text-center date_helper">
						<div class="big">{{ date('d', strtotime($event->start_date)) }}</div>
						<div class="small">{{ date('F\'y', strtotime($event->start_date)) }}</div>
						<small>{{ Helper::daysDiff($event->start_date, $event->end_date) }} day</small>
					</div>
				</div>
				<div class="col-md-10">
					<a href="{{ URL::route('events.show', $event->url) }}">
						<h3 style="margin-top:0;" class="bold">{{ $event->title }}</h3 style="margin-top:0;">
					</a>

					<p>{{ Str::limit($event->event, 300) }}</p>
					<a class="btn btn-success btn-sm" href="{{ URL::route('events.show', $event->url) }}"> Read More</a>
				</div>
			</div>
			<hr/>
		@endforeach

		{{ $events->links() }}
    </div>
@stop