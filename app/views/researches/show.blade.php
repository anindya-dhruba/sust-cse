@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.researches') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Research
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>Research Name:</h4>
				{{ $research->name }}
				<br/>
				<br/>
				
				<h4>Research Details:</h4>
				{{ $research->description }}
			</div>

			<div class="col-md-3">
				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link($research->url, URL::to($research->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($research->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($research->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.researches.edit', array('url' => $research->url)) }}" class='btn btn-success btn-block' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-edit"></span> Edit this Research Topic
				</a>
			</div>
		</div>
	</div>
@stop