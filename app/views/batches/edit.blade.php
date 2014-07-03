@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.batches') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Batches
			</a>
		</h3>
		<hr/>

		{{ Form::open(array('route' => array('admin.batches.edit',  $batch->year), 'method' => 'put')) }}

			@include('includes.alert')

			{{ Form::hidden('batchId', $batch->id) }}
	        
	        <div class="form-group">
	          	{{ Form::label('name', 'Batch Name *') }}
	          	{{ Form::text('name', $batch->name, array('class' => 'form-control')) }}
	          	<p class="help-block">Example: 21st Batch</p>
	          	{{ Form::error($errors, 'name') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('year', 'Batch Year *') }}
	          	{{ Form::text('year', $batch->year, array('class' => 'form-control')) }}
	          	{{ Form::error($errors, 'year') }}
	        </div>
        	
        	{{ Form::submit('Update Batch', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>

@stop