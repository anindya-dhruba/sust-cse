@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.notices') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Notices
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>Notice Title:</h4>
				{{ $notice->title }}
				<br/>
				<br/>
				
				<h4>Notice Content:</h4>
				{{ $notice->notice }}
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($notice->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link(URL::route('notices.show',$notice->url), URL::route('notices.show',$notice->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $notice->user->full_name }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($notice->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($notice->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.notices.edit', array('url' => $notice->url)) }}" class='btn btn-success btn-block input-block-level'>
					<span class="glyphicon glyphicon-edit"></span> Edit this Notice
				</a>
			</div>
		</div>
	</div>
@stop