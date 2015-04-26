@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $news->title }} <small> - {{ date('d F, Y', strtotime($news->created_at)) }}</small>
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>
		
		{{ $news->news }}

		<hr>
		<small>Created on {{ Helper::date($news->created_at, true) }}</small>
    </div>
@stop