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

        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    {{ Form::select('batch', $batches, isset($batch) ? $batch->year : null, ['class' => 'form-control', 'id' => 'select_batch']) }}
                    {{ Form::error($errors, 'first_name') }}
                </div>
            </div>
        </div>

        @if(isset($students) && count($students))
            <div class="row">
                @foreach($students as $student)
                    <a href="{{ URL::route('students.show', [$batch->type, $batch->year, $student->reg]) }}">
                        <div class="col-md-3">
                            <div class="thumbnail thumbnail-list text-center">
                                {{ Helper::currentPicture($student) }}
                                <div class="caption">
                                    <h4>{{ $student->last_name}}, {{ $student->first_name}} {{ $student->middle_name}}</h4>
                                    <p>{{ $student->reg }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        @elseif(isset($students))
            <div class="alert alert-success">
                No Student Found.
            </div>
        @else
        <div class="alert alert-success">
            Please select batch.
        </div>
        @endif
    </div>
@stop

@section('script')
    {{ HTML::script('js/matchHeight.js') }}
    <script type="text/javascript">
        $(function()
        {
            $('#select_batch').on('change', function(e){
                window.location.href = "{{URL::to('batches/'.$type)}}"+'/'+$(this).find(":selected").attr("value");
            });

            $('.thumbnail-list').matchHeight();
        });
    </script>
@stop