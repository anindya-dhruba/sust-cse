@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::previous() }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> Go Back
			</a>
			<hr/>
		</h3>

		@include('includes.alert')

		@for($i=0; $i<count($stuffs); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($stuffs[$i]) }}
					<div class="caption">
						<h4>{{ $stuffs[$i]->full_name}}</h4>
						<p>
							{{ $stuffs[$i]->designation }}

							@if($stuffs[$i]->status != 'Current')
								<span class="label label-default">{{ $stuffs[$i]->status }}</span>
							@endif
							<br/>

							<div class="btn-group">
								@if($stuffs[$i]->website)
									<a class="btn btn-sm btn-primary" href="{{ $stuffs[$i]->website }}" target="_blank">Homepage</a>
								@endif
								<a class="btn btn-sm btn-primary" href="{{ URL::route('stuffs.show', $stuffs[$i]->tagname) }}">Profile</a>
							</div>
						</p>
					</div>
				</div>
			</div>
		@endfor
		</div>
	</div>
@stop