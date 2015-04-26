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
				<a href="{{URL::route('students.graduate')}}" class="btn btn-primary btn-block big-menu">
					<i class="fa fa-users"></i><br/>
					Graduate Students List
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{URL::route('students.undergraduate')}}" class="btn btn-success btn-block big-menu">
					<i class="fa fa-users"></i><br/>
					Undergraduate Students List
				</a>
			</div>
			<div class="col-md-12">
				<div style="margin: 20px;"></div>
			</div>
			<div class="col-md-12">
				<a href="{{URL::route('batches')}}" class="btn btn-success btn-block big-menu">
					<i class="fa fa-th-large"></i><br/>
					View All Batches
				</a>
			</div>
		</div>
	</div>
@stop