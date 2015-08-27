@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
			</h3>
		</div>
		<div class="row">
            <div class="col-md-6">

                <div class="panel panel-success">
                    <div class="panel-heading">Graduate Students</div>

                    <ul class="list-group">
                        <a class="list-group-item" href="{{URL::route('batches.type', 'Graduate-Masters')}}">
                            <h4 class="list-group-item-heading">Master of Science - M.Sc.</h4>
                            <p class="list-group-item-text">
                                Total {{ count($mastersBatches);  }} Batches<br/>
                                Total {{ $mastersStudents;  }} Students
                            </p>
                        </a>
                        <a class="list-group-item" href="{{URL::route('batches.type', 'Graduate-Ph.D.')}}">
                            <h4 class="list-group-item-heading">Doctor of Philosophy - Ph.D.</h4>
                            <p class="list-group-item-text">
                                Total {{ count($phdBatches);  }} Batches<br/>
                                Total {{ $phdStudents;  }} Students
                            </p>
                        </a>
                    </ul>
                </div>

            </div>

            <div class="col-md-6">

                <div class="panel panel-success">
                    <div class="panel-heading">Undergraduate Students</div>

                    <ul class="list-group">
                        <a class="list-group-item" href="{{URL::route('batches.type', 'Undergraduate-Major')}}">
                            <h4 class="list-group-item-heading">Bachelor of Science - B.Sc. (Major)</h4>
                            <p class="list-group-item-text">
                                Total {{ count($majorHonoursBatches);  }} Batches<br/>
                                Total {{ $majorHonoursStudents;  }} Students
                            </p>
                        </a>
                        <a class="list-group-item" href="{{URL::route('batches.type', 'Undergraduate-Second Major')}}">
                            <h4 class="list-group-item-heading">Bachelor of Science - B.Sc. (Second Major)</h4>
                            <p class="list-group-item-text">
                                Total {{ count($minorHonoursBatches);  }} Batches<br/>
                                Total {{ $minorHonoursStudents;  }} Students
                            </p>
                        </a>
                    </ul>
                </div>
            </div>
		</div>
	</div>
@stop