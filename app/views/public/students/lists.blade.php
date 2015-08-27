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

            @for($i=0; $i<count($students); $i++)

                @if($i == 0)
                    <div class="row">
                        @elseif($i%3 == 0)
                    </div>
                    <div class="row">
                        @endif

                        <div class="col-md-4">
                            <div class="thumbnail text-center">
                                {{ Helper::currentPicture($students[$i]) }}
                                <div class="caption">
                                    <h5>{{ $students[$i]->last_name}}, {{ $students[$i]->first_name}} {{ $students[$i]->middle_name}}</h5>
                                    <p>{{ $students[$i]->reg }}</p>
                                    <a class="btn btn-primary btn-block" href="{{ URL::route('students.show', [$batch->type, $batch->year, $students[$i]->reg]) }}">More</a>
                                </div>
                            </div>
                        </div>
                        @endfor
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
		</div>
    </div>
@stop

@section('script')
    <script type="text/javascript">
        $(function()
        {
            $('#select_batch').on('change', function(e){
                window.location.href = "{{URL::to('batches/'.$type)}}"+'/'+$(this).find(":selected").attr("value");
            });
        });
    </script>
@stop