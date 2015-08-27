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

		{{ Form::open(array('route' => array('admin.batches.edit', $batch->type, $batch->year), 'method' => 'put')) }}

			@include('includes.alert')

			{{ Form::hidden('batchId', $batch->id) }}
	        
	        <div class="form-group">
	          	{{ Form::label('type', 'Batch Type *') }}
	          	{{ Form::select('type', Batch::typeList(), $batch->type, array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'type') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('year', 'Batch Year *') }}
	          	{{ Form::text('year', $batch->year, array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'year') }}
	        </div>
        	
        	{{ Form::submit('Update Batch', array('class' => 'btn btn-primary btn-lg', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>

@stop