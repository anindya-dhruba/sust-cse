@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('notices') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Notices
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')
		<h4>Notice Title:</h4>
		{{ $notice->title }}
		<hr/>
		<h4>Notice Url:</h4>
		{{ URL::route('notices') }}/{{$notice->url }}
		<hr/>
		<h4>Content:</h4>
		<div class="well">{{ $notice->notice }}</div>
		<hr/>
		<a href="{{ URL::route('notices.edit', array('pageUrl' => $notice->url)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this Notice
			</a>
	</div>
@stop