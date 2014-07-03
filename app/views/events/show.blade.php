@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.events') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Events
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>Event Title:</h4>
				{{ $event->title }}
				<br/>
				<br/>

				<h4>Event Date Range:</h4>
				<mark>{{ Helper::date($event->start_date) }}</mark> - <mark>{{ Helper::date($event->end_date) }}</mark>
				<br/>
				<br/>

				<h4>Event Duration:</h4>
				{{ Helper::daysDiff($event->start_date, $event->end_date) }} day
				<br/>
				<br/>
				
				<h4>Event Description:</h4>
				{{ $event->event }}
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($event->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link(URL::route('events.show',$event->url), URL::route('events.show',$event->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $event->user->full_name }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($event->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($event->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.events.edit', array('url' => $event->url)) }}" class='btn btn-success btn-block input-block-level'>
					<span class="glyphicon glyphicon-edit"></span> Edit this Event
				</a>
			</div>
		</div>
	</div>
@stop