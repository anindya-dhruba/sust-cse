@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>{{ $title }}</h3>
		</div>

		@include('includes.alert')

		<div class="row-fluid">
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($hotd) }}
					<div class="caption">
						<h4>{{ $hotd->last_name}}, {{ $hotd->first_name}} {{ $hotd->middle_name}}</h4>
						<p>
							{{ $hotd->designation }}

							@if($hotd->status != 'Current')
								<span class="label label-danger">{{ $hotd->status }}</span>
								<br/>
							@endif

							<div class="btn-group">
								@if($hotd->website)
									<a class="btn btn-sm btn-primary" href="{{ $hotd->website }}" target="_blank">Homepage</a>
								@endif
								<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $hotd->tagname) }}">Profile</a>
							</div>
						</p>
					</div>
				</div>
			</div>


			@for($i=0; $i<count($professors); $i++)
				<div class="col-md-4">
					<div class="thumbnail text-center">
						{{ Helper::currentPicture($professors[$i]) }}
						<div class="caption">
							<h4>{{ $professors[$i]->last_name}}, {{ $professors[$i]->first_name}} {{ $professors[$i]->middle_name}}</h4>
							<p>
								{{ $professors[$i]->designation }}

								@if($professors[$i]->status != 'Current')
									<span class="label label-default">{{ $professors[$i]->status }}</span>
								@endif
								<br/>

								<div class="btn-group">
									@if($professors[$i]->website)
										<a class="btn btn-sm btn-primary" href="{{ $professors[$i]->website }}" target="_blank">Homepage</a>
									@endif
									<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $professors[$i]->tagname) }}">Profile</a>
								</div>
							</p>
						</div>
					</div>
				</div>
			@endfor

			@for($i=0; $i<count($aProfessors); $i++)
				<div class="col-md-4">
					<div class="thumbnail text-center">
						{{ Helper::currentPicture($aProfessors[$i]) }}
						<div class="caption">
							<h4>{{ $aProfessors[$i]->last_name}}, {{ $aProfessors[$i]->first_name}} {{ $aProfessors[$i]->middle_name}}</h4>
							<p>
								{{ $aProfessors[$i]->designation }}

								@if($aProfessors[$i]->status != 'Current')
									<span class="label label-default">{{ $aProfessors[$i]->status }}</span>
								@endif
								<br/>

								<div class="btn-group">
									@if($aProfessors[$i]->website)
										<a class="btn btn-sm btn-primary" href="{{ $aProfessors[$i]->website }}" target="_blank">Homepage</a>
									@endif
									<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $aProfessors[$i]->tagname) }}">Profile</a>
								</div>
							</p>
						</div>
					</div>
				</div>
			@endfor

			@for($i=0; $i<count($assisProfessors); $i++)
				<div class="col-md-4">
					<div class="thumbnail text-center">
						{{ Helper::currentPicture($assisProfessors[$i]) }}
						<div class="caption">
							<h4>{{ $assisProfessors[$i]->last_name}}, {{ $assisProfessors[$i]->first_name}} {{ $assisProfessors[$i]->middle_name}}</h4>
							<p>
								{{ $assisProfessors[$i]->designation }}

								@if($assisProfessors[$i]->status != 'Current')
									<span class="label label-default">{{ $assisProfessors[$i]->status }}</span>
								@endif
								<br/>

								<div class="btn-group">
									@if($assisProfessors[$i]->website)
										<a class="btn btn-sm btn-primary" href="{{ $assisProfessors[$i]->website }}" target="_blank">Homepage</a>
									@endif
									<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $assisProfessors[$i]->tagname) }}">Profile</a>
								</div>
							</p>
						</div>
					</div>
				</div>
			@endfor

			@for($i=0; $i<count($lecturers); $i++)
				<div class="col-md-4">
					<div class="thumbnail text-center">
						{{ Helper::currentPicture($lecturers[$i]) }}
						<div class="caption">
							<h4>{{ $lecturers[$i]->last_name}}, {{ $lecturers[$i]->first_name}} {{ $lecturers[$i]->middle_name}}</h4>
							<p>
								{{ $lecturers[$i]->designation }}

								@if($lecturers[$i]->status != 'Current')
									<span class="label label-default">{{ $lecturers[$i]->status }}</span>
								@endif
								<br/>

								<div class="btn-group">
									@if($lecturers[$i]->website)
										<a class="btn btn-sm btn-primary" href="{{ $lecturers[$i]->website }}" target="_blank">Homepage</a>
									@endif
									<a class="btn btn-sm btn-primary" href="{{ URL::route('faculty.show', $lecturers[$i]->tagname) }}">Profile</a>
								</div>
							</p>
						</div>
					</div>
				</div>
			@endfor
		</div>
	</div>
@stop