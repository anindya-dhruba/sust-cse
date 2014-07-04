@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
		</h3>
		<hr/>

		@include('includes.alert')
		
		<div class="row">
			<div class="col-md-12">
				<img src="{{ URL::to('uploads/album_pictures/slider_'.$picture->file_url) }}">
			</div>


			<!-- <div class="col-md-12 vspace">
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
					<dd>{{ HTML::link(URL::route('admin.pictures.show',$picture->url), URL::route('admin.pictures.show',$picture->url)) }}</dd>
				</dl>

				<dl>
					<dt>Created By:</dt>
					<dd>{{ $picture->user->full_name }}</dd>
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
			</div> -->
		</div>
	</div>
@stop