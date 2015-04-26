@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pictures') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Pictures
				</a>
			</h3>
		</div>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-3">
				<img src="{{ URL::to('uploads/album_pictures/medium_'.$picture->file_url) }}">
			</div>
			<div class="col-md-5 col-md-offset-1 border-right">
				<h4>Caption</h4>
				{{ $picture->caption }}
				<br/>
				<br/>

				<h4>Album:</h4>
				{{ $picture->album->name }}
				<br/>
				<br/>

				<h4>Details:</h4>
				{{ $picture->details }}
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($picture->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link(URL::route('pictures.show', [$picture->album->url, $picture->url]), URL::route('pictures.show',[$picture->url, $picture->url])) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $picture->user->last_name }}, {{ $picture->user->first_name }} {{ $picture->user->middle_name }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($picture->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($picture->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.pictures.edit', array('url' => $picture->url)) }}" class='btn btn-success btn-block input-block-level'>
					<span class="glyphicon glyphicon-edit"></span> Edit this picture
				</a>
			</div>
		</div>
	</div>
@stop