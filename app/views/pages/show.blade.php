@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pages') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')
		
		<h4>Page Title:</h4>
		{{ $page->title }}
		<hr/>
		
		<h4>Is public?</h4>
			@if($page->is_public)
				<span class="glyphicon glyphicon-ok text-success"></span> Public
			@else
				<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
			@endif
		<hr/>
		
		<h4>Page Url:</h4>
		{{ HTML::link($page->url, URL::to($page->url)) }}
		<hr/>
		
		<h4>Content:</h4>
		<div class="well">{{ $page->content }}</div>
		<hr/>
		
		
		@if(!$page->can_update)
			<div class="alert alert-info">You can't update this page, This page will automatically fetch content!</div>
		@endif


		@if($page->can_update)
			<a href="{{ URL::route('admin.pages.edit', array('url' => $page->url)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this Page
			</a>
		@endif
	</div>
@stop