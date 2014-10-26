@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>{{ $title }}</h3>
		</div>

      	<p>{{ $research->description }}</p>
        <br/>
      	<p>
      		<h4>The following users researched on this topic:</h4>
      		<ul>
      			@foreach($research->users as $user)
      				<li>
      					<a href="{{ URL::route('faculty.show', $user->tagname) }}">{{ $user->full_name }}</a>
      				</li>
      			@endforeach
      		</ul>
      	</p>
    </div>
@stop