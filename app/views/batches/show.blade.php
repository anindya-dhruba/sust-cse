@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.batches') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All Batches
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<h4>Batch Name:</h4>
		{{ $batch->name }}
		<hr/>
		<h4>Batch Year:</h4>
		{{ $batch->year }}
		<hr/>
		<h4>Number of Students:</h4>
		{{ $batch->users->count() }} students
		<hr/>
		<a href="{{ URL::route('admin.batches.edit', array('year' => $batch->year)) }}" class='btn btn-success btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this Batch
			</a>
	</div>
@stop