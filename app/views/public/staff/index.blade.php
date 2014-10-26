@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::previous() }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>

		@include('includes.alert')

		@for($i=0; $i<count($staff); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($staff[$i]) }}
					<div class="caption">
						<h4>{{ $staff[$i]->full_name}}</h4>
						<p>
							{{ $staff[$i]->designation }}

							@if($staff[$i]->status != 'Current')
								<span class="label label-default">{{ $staff[$i]->status }}</span>
							@endif
							<br/>

							<div class="btn-group">
								@if($staff[$i]->website)
									<a class="btn btn-sm btn-primary" href="{{ $staff[$i]->website }}" target="_blank">Homepage</a>
								@endif
								<a class="btn btn-sm btn-primary" href="{{ URL::route('staff.show', $staff[$i]->tagname) }}">Profile</a>
							</div>
						</p>
					</div>
				</div>
			</div>
		@endfor
		</div>
	</div>
@stop