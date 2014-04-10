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

		{{ Form::open(array('route' => array('faq.edit',  $faq->url), 'method' => 'put')) }}

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
			      	<span class="input-group-addon"> {{ Url::route('faq') }}/</span>
			      	{{ Form::text('url', $faq->url, array('class' => 'form-control url')) }}
			    </div>
			    {{ Form::error($errors, 'url') }}
	        </div>

	        <div class="form-group">
	          	{{ Form::label('answer', 'Answer *') }}
	          	{{ Form::textarea('answer', $faq->answer, array('class' => 'form-control editor')) }}
	          	{{ Form::error($errors, 'answer') }}
	        </div>

        	
        	{{ Form::submit('Update Page', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}

		{{ Form::close() }}
	</div>

	<script type="text/javascript">
		$(document).ready(function() {

			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('faq.slug')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});

		});
	</script>


@stop