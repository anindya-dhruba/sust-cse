@extends('layouts.email')

@section('content')
	<h2>Password Reset</h2>

	<div>
		To reset your password, complete this form: {{ URL::route('password.reset', array('token' => $token)) }}.
	</div>
@stop