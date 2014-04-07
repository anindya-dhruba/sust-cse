@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h2>{{ $title }}</h2>
		</div>

      	{{ $page->content }}
    </div>
@stop