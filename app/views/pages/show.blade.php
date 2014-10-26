@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pages') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>Page Title:</h4>
				{{ $page->title }}
				<br/>
				<br/>
				
				<h4>Page Content:</h4>
				{{ $page->content }}

				@if(!$page->can_update)
					<div class="alert alert-info">You can't update this page, This page will automatically fetch content!</div>
				@endif
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($page->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link($page->url, URL::to($page->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($page->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($page->updated_at,  true) }}</dd>
				</dl>

				@if($page->can_update)
					<a href="{{ URL::route('admin.pages.edit', array('url' => $page->url)) }}" class='btn btn-success btn-block' style="vertical-align: middle;">
						<span class="glyphicon glyphicon-edit"></span> Edit this Page
					</a>
				@endif
			</div>
		</div>
	</div>
@stop