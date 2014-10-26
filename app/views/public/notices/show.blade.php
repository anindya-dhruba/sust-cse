@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $notice->title }} <small> - {{ date('d F, Y', strtotime($notice->created_at)) }}</small>
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>
		
		{{ $notice->notice }}

		<hr>
		<small>Created on {{ Helper::date($notice->created_at, true) }}</small>
    </div>
@stop