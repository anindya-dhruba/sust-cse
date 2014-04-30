@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $batch->name }} Batch <small> - {{ $batch->year }} year</small>
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
			<hr/>
		</div>
		
		<?php $students = $batch->students()->orderBy('reg')->get(); ?>

		@if(count($students))
			
			@for($i=0; $i<count($students); $i++)

				@if($i == 0)
					<div class="row">
				@elseif($i%3 == 0)
					</div>
					<div class="row">
				@endif
					<a href="{{ $students[$i]->reg }}">
						<div class="col-md-4">
							<div class="thumbnail text-center">
								{{ Helper::currentPicture($students[$i]) }}
								<div class="caption">
									<h4>{{ $students[$i]->user->full_name}}</h4>
									<p>{{ $students[$i]->reg }}</p>
								</div>
							</div>
						</div>
					</a>
			@endfor
			</div>

		@else
			<div class="alert alert-success">
				No Student Found.
			</div>
		@endif
		</div>
    </div>
@stop