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

        <div class="row">
            @foreach($staff as $singleStaff)
                <a href="{{ URL::route('staff.show', $singleStaff->tagname) }}">
                    <div class="col-md-3">
                        <div class="thumbnail thumbnail-list text-center">
                            {{ Helper::currentPicture($singleStaff) }}
                            <div class="caption">
                                <h4>{{ $singleStaff->last_name}}, {{ $singleStaff->first_name}} {{ $singleStaff->middle_name}}</h4>
                                <p>
                                    {{ $singleStaff->designation }}

                                    @if($singleStaff->status != 'Current')
                                        <span class="label label-default">{{ $singleStaff->status }}</span>
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