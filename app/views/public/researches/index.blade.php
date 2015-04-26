@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>Research Areas</h3>
		</div>
		<table class="table table-bordered table-striped">
			<tbody>
				@foreach($researches as $research)
				<tr>
					<td style="vertical-align: middle">
						<a href="{{ URL::route('researches.show', $research->url) }}">{{ $research->name }}</a>
					</td>
					<td style="text-align: left;">
						<ul>
							@foreach($research->users as $user)
								<li><a href="{{ URL::route('faculty.show', $user->tagname) }}">{{ $user->last_name }}, {{ $user->first_name }} {{ $user->middle_name }}</a></li>
							@endforeach
						</ul>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
    </div>
@stop