@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::previous() }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> Go Back
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<div class="row">
			<div class="col-md-8">
				<table class="table table-bordered table-striped">
					<tr>
						<th>Full Name</th>
						<td>{{ $admin->full_name }}</td>
					</tr>
					<tr>
						<th>Nick Name</th>
						<td>{{ $admin->nick_name }}</td>
					</tr>
					<tr>
						<th>Email Address</th>
						<td>{{ $admin->email }}</td>
					</tr>
				</table>
			</div>
			<div class="col-md-4">
				<div class="thumbnail text-center">
			      	{{ Helper::currentPicture($admin) }}
			      	<div class="caption">
			        	@if(Auth::id() == $admin->id)
			        		<a href="{{ URL::route('profile.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-edit"></span> Edit Profile</a>
			        		<a href="{{ URL::route('password.edit') }}" class="btn btn-success btn-block"><span class="glyphicon glyphicon-lock"></span> Edit Password</a>
			        	@endif
			      	</div>
			    </div>
			</div>
		</div>
	</div>
@stop