@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>{{ $title }}</h3>
		</div>

		@include('includes.alert')

		<div class="row">
            @if(isset($hotd))
                <a href="{{ URL::route('faculty.show', $hotd->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($hotd) }}
                            <div class="caption">
                                <h4>{{ $hotd->last_name}}, {{ $hotd->first_name}} {{ $hotd->middle_name}}</h4>
                                <p>
                                    {{ $hotd->designation }}
                                    @if($hotd->status != 'Current')
                                        <span class="label label-danger">{{ $hotd->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
            @endif

			@foreach($professors as $professor)
                <a href="{{ URL::route('faculty.show', $professor->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($professor) }}
                            <div class="caption">
                                <h4>{{ $professor->last_name}}, {{ $professor->first_name}} {{ $professor->middle_name}}</h4>
                                <p>
                                    {{ $professor->designation }}

                                    @if($professor->status != 'Current')
                                        <span class="label label-default">{{ $professor->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
			@endforeach

			@foreach($aProfessors as $aProfessor)
                <a href="{{ URL::route('faculty.show', $aProfessor->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($aProfessor) }}
                            <div class="caption">
                                <h4>{{ $aProfessor->last_name}}, {{ $aProfessor->first_name}} {{ $aProfessor->middle_name}}</h4>
                                <p>
                                    {{ $aProfessor->designation }}

                                    @if($aProfessor->status != 'Current')
                                        <span class="label label-default">{{ $aProfessor->status }}</span>
                                    @endif

                                </p>
                            </div>
                        </div>
                    </div>
                </a>
			@endforeach

			@foreach($assisProfessors as $assisProfessor)
                <a href="{{ URL::route('faculty.show', $assisProfessor->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($assisProfessor) }}
                            <div class="caption">
                                <h4>{{ $assisProfessor->last_name}}, {{ $assisProfessor->first_name}} {{ $assisProfessor->middle_name}}</h4>
                                <p>
                                    {{ $assisProfessor->designation }}

                                    @if($assisProfessor->status != 'Current')
                                        <span class="label label-default">{{ $assisProfessor->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
			@endforeach

			@foreach($lecturers as $lecturer)
                <a href="{{ URL::route('faculty.show', $lecturer->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($lecturer) }}
                            <div class="caption">
                                <h4>{{ $lecturer->last_name}}, {{ $lecturer->first_name}} {{ $lecturer->middle_name}}</h4>
                                <p>
                                    {{ $lecturer->designation }}

                                    @if($lecturer->status != 'Current')
                                        <span class="label label-default">{{ $lecturer->status }}</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </a>
			@endforeach
		</div>
	</div>
@stop


@section('script')
    {{ HTML::script('js/matchHeight.js') }}
    <script type="text/javascript">
        $(function()
        {
            $('.thumbnail-list').matchHeight();
        });
    </script>
@stop