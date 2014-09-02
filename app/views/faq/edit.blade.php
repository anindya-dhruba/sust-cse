@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.faqs') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All FAQ's
			</a>
		</h3>
		<hr/>

		{{ Form::open(array('route' => array('admin.faqs.edit',  $faq->url), 'method' => 'put')) }}

			@include('includes.alert')

			{{ Form::hidden('faqID', $faq->id) }}
	        
	        <div class="form-group">


	          	{{ Form::label('question', 'Question *') }}
	          	{{ Form::text('question', $faq->question, array('class' => 'form-control title')) }}
	          	{{ Form::error($errors, 'question') }}
	        </div>


	        
	        <div class="form-group">
	        	{{ Form::label('url', 'Url *') }}
	        	<div class="input-group">
			      	<span class="input-group-addon"> {{ Url::route('faqs') }}/</span>
			      	{{ Form::text('url', $faq->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('answer', 'Answer *') }}
	          	{{ Form::textarea('answer', $faq->answer, array('class' => 'form-control ckeditor')) }}
	          	{{ Form::error($errors, 'answer') }}
	        </div>

        	
        	{{ Form::submit('Update Page', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('admin.faqs.slug')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});

		});
	</script>


@stop