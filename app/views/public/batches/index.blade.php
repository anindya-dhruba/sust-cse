@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<h3>Current Batches</h3>
		<div class="list-group">
			@for($i=0; $i<5; $i++)
				<a href="{{ URL::route('batches.show', $batches[$i]->year) }}" class="list-group-item">
					<h4 class="list-group-item-heading">
						{{ $batches[$i]->name }} Batch
					</h4>
					<p class="list-group-item-text">Year {{ $batches[$i]->year }} - {{ $batches[$i]->students->count() }} Students</p>
				</a>
			@endfor
		</div>

		<h3>Past Batches</h3>
		<div class="list-group">
			@for($i=5; $i<count($batches); $i++)
				<a href="{{ URL::route('batches.show', $batches[$i]->year) }}" class="list-group-item">
					<h4 class="list-group-item-heading">
						{{ $batches[$i]->name }} Batch
					</h4>
					<p class="list-group-item-text">Year {{ $batches[$i]->year }} - {{ $batches[$i]->students->count() }} Students</p>
				</a>
			@endfor
		</div>
    </div>
@stop