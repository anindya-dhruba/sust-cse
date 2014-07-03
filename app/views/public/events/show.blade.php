@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $event->title }}
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
			{{ Helper::date($event->start_date) }} - {{ Helper::date($event->start_date) }} <mark>({{ Helper::daysDiff($event->start_date, $event->end_date) }} day)</mark>
			<hr/>
		</div>
		
		{{ $event->event }}

    </div>
@stop