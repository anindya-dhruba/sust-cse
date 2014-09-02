@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.albums') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Albums
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-9 border-right">
				<h4>Album Name:</h4>
				{{ $album->name }}
				<br/>
				<br/>

				<h4>Album Details:</h4>
				{{ $album->details }}
				<br/>

				<h4>Album Pictures:</h4>
				<p>{{ $album->pictures->count() }} pictures</p>
				<?php foreach ($album->pictures as $key => $picture): ?>
					<img class="img-thumbnail" src="{{ URL::to('uploads/album_pictures/thumbnail_'.$picture->file_url) }}">
				<?php endforeach ?>
			</div>

			<div class="col-md-3">
				<dl>
					<dt>Is public?:</dt>
					<dd>
						@if($album->is_public)
							<span class="glyphicon glyphicon-ok text-success"></span> Public
						@else
							<span class="glyphicon glyphicon-remove text-danger"></span> Not Public
						@endif
					</dd>
				</dl>

				<dl>
					<dt>URL:</dt>
					<dd>{{ HTML::link(URL::route('admin.albums.show',$album->url), URL::route('admin.albums.show',$album->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $album->user->full_name }}</dd>
				</dl>

				<dl>
					<dt>Created At:</dt>
					<dd>{{ Helper::date($album->created_at,  true) }}</dd>
				</dl>

				<dl>
					<dt>Updated At:</dt>
					<dd>{{ Helper::date($album->updated_at,  true) }}</dd>
				</dl>

				<a href="{{ URL::route('admin.albums.edit', array('url' => $album->url)) }}" class='btn btn-success btn-block input-block-level'>
					<span class="glyphicon glyphicon-edit"></span> Edit this album
				</a>
			</div>
		</div>
	</div>
@stop