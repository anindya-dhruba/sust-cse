@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.researches') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Research
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		<div class="row">
			{{ Form::open(array('route' => array('admin.researches.edit',  $research->url), 'method' => 'put')) }}
				<div class="col-md-4">
						<br/>
						<div class="alert alert-warning">
							<h4>Instructions:</h4>
							<ol>
								<li>Fields with <b>*</b> are required.</li>
								<li>Edit the form correctly.</li>
								<li>Click <b>update research topic</b> when you are done.</li>
							</ol>
						</div>
				</div>

				<div class="col-md-8">

					{{ Form::hidden('researchId', $research->id) }}

			        <div class="form-group">
			          	{{ Form::label('name', 'Name *') }}
			          	{{ Form::text('name', $research->name, array('class' => 'form-control name')) }}
			          	{{ Form::error($errors, 'name') }}
			        </div>
			        
			        <div class="form-group">
			        	{{ Form::label('url', 'Url *') }}
			        	<div class="input-group">
					      	<span class="input-group-addon"> {{ Url::route('home') }}/</span>
					      	{{ Form::text('url', $research->url, array('class' => 'form-control url')) }}
					    </div>
					    {{ Form::error($errors, 'url') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('description', 'Description *') }}
			          	{{ Form::textarea('description', $research->description, array('class' => 'form-control summernote')) }}
			          	{{ Form::error($errors, 'description') }}
			        </div>
		        	
		        	{{ Form::submit('Update Research Topic', array('class' => 'btn btn-primary', 'data-loading-text' => 'Updating...', 'type' => 'button')) }}
		        </div>
			{{ Form::close() }}
		</div>
	</div>

@stop

@section('script')
	{{ HTML::style('summernote/dist/summernote.css') }}
	{{ HTML::script('summernote/dist/summernote.js') }}
	{{ HTML::script('js/summernote-init.js') }}

	<script type="text/javascript">
		$(document).ready(function() {

			// gets slug/url
			$('.name').on('input', function() {
				$.post("{{ URL::route('admin.researches.generateUrl')}}", { name: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});
		});
	</script>
@stop