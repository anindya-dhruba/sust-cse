@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::previous() }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> Go Back
			</a>
		</h3>
		<hr/>
		@include('includes.alert')

		@for($i=0; $i<count($faculty); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($faculty[$i]) }}
					<div class="caption">
						<h4>{{ $faculty[$i]->user->full_name}}</h4>
						<p>
							{{ $faculty[$i]->designation }}

							@if($faculty[$i]->status != 'Current')
								<span class="label label-default">{{ $faculty[$i]->status }}</span>
							@endif
							<br/>

							<div class="btn-group">
								@if($faculty[$i]->website)
									<a class="btn btn-sm btn-primary" href="{{ $faculty[$i]->website }}" target="_blank">Homepage</a>
								@endif
								<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $faculty[$i]->tagname) }}">Profile</a>
							</div>
						</p>
					</div>
				</div>
			</div>	
		@endfor
		</div>

	</div>
@stop