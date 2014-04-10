@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('faq') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-chevron-left"></span> View All FAQ's
				</a>
			</h3>
		</div>
		<hr/>
		@include('includes.alert')

		<h4>FAQ Url:</h4>
		{{ URL::route('faq') }}/{{$faq->url }}
		<hr/>


		<h4>Question :</h4>
		{{ $faq->question }}
		<hr/>

		
		<h4>Answer :</h4>
		{{ $faq->answer }}
		<hr/>
		<a href="{{ URL::route('faq.edit', array('pageUrl' => $faq->url)) }}" class='btn btn-warning btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this FAQ
			</a>
	</div>
@stop