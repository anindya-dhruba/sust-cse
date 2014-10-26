@extends('layouts.email')

@section('content')
	<h2>Welcome to {{ Config::get('myConfig.siteName') }}</h2>

	<div>
		An staff account was created for you at {{ Config::get('myConfig.siteName') }}. You can login with the following credentials:
		<ul>
			<li>URL: {{ URL::route('login') }}</li>
			<li>Email Address: {{ $email }}</li>
			<li>Password: {{ $password }}</li>
		</ul>

		<p>
			<strong>Please change your password after login.</strong><br/>
		</p>
		
	</div>

@stop