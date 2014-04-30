@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.notices') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Notices
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')
		<h4>Notice Title:</h4>
		{{ $notice->title }}
		<hr/>
		<h4>Is public?</h4>
			@if($notice->is_public)
				<span class="glyphicon glyphicon-ok text-success"></span> Public
			@else
				<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
			@endif
		<hr/>
		<h4>Notice Url:</h4>
		{{ HTML::link(URL::route('notices.show',$notice->url), URL::route('notices.show',$notice->url)) }}
		<hr/>
		<h4>Content:</h4>
		<div class="well">{{ $notice->notice }}</div>
		<hr/>
		<a href="{{ URL::route('admin.notices.edit', array('url' => $notice->url)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this Notice
			</a>
	</div>
@stop