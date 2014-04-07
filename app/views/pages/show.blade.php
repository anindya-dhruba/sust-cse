@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('pages') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')
		<h4>Page Title:</h4>
		{{ $page->title }}
		<hr/>
		<h4>Page Visiblity:</h4>
			@if($page->is_visible)
				<span class="glyphicon glyphicon-ok text-success"></span> Visible
			@else
				<span class="glyphicon glyphicon-remove text-danger"></span> Not Visible
			@endif
		<hr/>
		<h4>Page Url:</h4>
		{{ URL::route('home') }}/{{$page->url }}
		<hr/>
		<h4>Content:</h4>
		<div class="well">{{ $page->content }}</div>
		<hr/>
		<a href="{{ URL::route('pages.edit', array('pageUrl' => $page->url)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this Page
			</a>
	</div>
@stop