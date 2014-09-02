@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		@include('includes.alert')

		<div class="page-header">
			<h4>{{ $hotd->designation }}</h4>
		</div>
		<div class="row">
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($hotd) }}
					<div class="caption">
						<h4>{{ $hotd->full_name}}</h4>
						<p>
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
		</div>

		<div class="page-header">
			<h4>Professors</h4>
		</div>
		@for($i=0; $i<count($professors); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($professors[$i]) }}
					<div class="caption">
						<h4>{{ $professors[$i]->full_name}}</h4>
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
		</div>

		<div class="page-header">
			<h4>Associate Professors</h4>
		</div>
		@for($i=0; $i<count($aProfessors); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($aProfessors[$i]) }}
					<div class="caption">
						<h4>{{ $aProfessors[$i]->full_name}}</h4>
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
		</div>

		<div class="page-header">
			<h4>Lecturers</h4>
		</div>
		@for($i=0; $i<count($lecturers); $i++)
			@if($i == 0)
				<div class="row">
			@elseif($i%3 == 0)
				</div>
				<div class="row">
			@endif	
			<div class="col-md-4">
				<div class="thumbnail text-center">
					{{ Helper::currentPicture($lecturers[$i]) }}
					<div class="caption">
						<h4>{{ $lecturers[$i]->full_name}}</h4>
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