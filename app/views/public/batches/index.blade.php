@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>Batches</h3>
		</div>
		<div class="col-md-6">
			<div class="list-group">
				@for($i=0; $i<count($batches)/2; $i++)
					<a href="{{ URL::route('batches.show', $batches[$i]->year) }}" class="list-group-item">
						<h4 class="list-group-item-heading">
							{{ $batches[$i]->name }} Batch
						</h4>
						<p class="list-group-item-text">Year {{ $batches[$i]->year }} - {{ $batches[$i]->users->count() }} Students</p>
					</a>
				@endfor
			</div>
		</div>
		<div class="col-md-6">
			<div class="list-group">
				@for($i=count($batches)/2 +1; $i<count($batches); $i++)
					<a href="{{ URL::route('batches.show', $batches[$i]->year) }}" class="list-group-item">
						<h4 class="list-group-item-heading">
							{{ $batches[$i]->name }} Batch
						</h4>
						<p class="list-group-item-text">Year {{ $batches[$i]->year }} - {{ $batches[$i]->users->count() }} Students</p>
					</a>
				@endfor
			</div>
		</div>
    </div>
@stop