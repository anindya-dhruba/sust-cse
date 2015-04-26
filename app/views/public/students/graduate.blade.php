@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title  }}
				<a href="{{ URL::route('students') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>

		@if(count($students))

			@for($i=0; $i<count($students); $i++)

				@if($i == 0)
					<div class="row">
				@elseif($i%4 == 0)
					</div>
					<div class="row">
				@endif

				<div class="col-md-3">
					<div class="thumbnail text-center">
						{{ Helper::currentPicture($students[$i]) }}
						<div class="caption">
							<h5>{{ $students[$i]->last_name}}, {{ $students[$i]->first_name}} {{ $students[$i]->middle_name}}</h5>
							<p>{{ $students[$i]->reg }}</p>
							<a class="btn btn-primary btn-block" href="{{ URL::route('students.show', [$students[$i]->batch->year, $students[$i]->reg]) }}">More</a>
						</div>
					</div>
				</div>
			@endfor
			</div>
			{{ $students->links() }}

		@else
			<div class="alert alert-success">
				No Student Found.
			</div>
		@endif
		</div>
    </div>
@stop