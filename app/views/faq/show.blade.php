@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.faqs') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-chevron-left"></span> View All FAQ's
				</a>
			</h3>
		</div>

		@include('includes.alert')

		<h4>FAQ Url:</h4>
		<a href="{{ URL::route('faqs') }}#{{$faq->url }}">{{ URL::route('faqs') }}#{{$faq->url }}</a>
		<hr/>


		<h4>Question :</h4>
		{{ $faq->question }}
		<hr/>

		
		<h4>Answer :</h4>
		{{ $faq->answer }}
		<hr/>
		<a href="{{ URL::route('admin.faqs.edit', array('pageUrl' => $faq->url)) }}" class='btn btn-success btn-sm pull-right' style="vertical-align: middle;">
				<span class="glyphicon glyphicon-edit"></span> Edit this FAQ
			</a>
	</div>
@stop