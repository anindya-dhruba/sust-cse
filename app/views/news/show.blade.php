@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.news') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All News
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>News Title:</h4>
				{{ $news->title }}
				<br/>
				<br/>
				
				<h4>News Content:</h4>
				{{ $news->news }}
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($news->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link(URL::route('news.show',$news->url), URL::route('news.show',$news->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $news->user->last_name }}, {{ $news->user->first_name }} {{ $news->user->middle_name }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($news->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($news->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.news.edit', array('url' => $news->url)) }}" class='btn btn-success btn-block input-block-level'>
					<span class="glyphicon glyphicon-edit"></span> Edit this News
				</a>
			</div>
		</div>
	</div>
@stop