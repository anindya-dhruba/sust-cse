@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.pages') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Pages
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		<div class="row"> 
			{{ Form::open(array('route' => 'admin.pages.add')) }}
				<div class="col-md-4">
					<br/>
					<div class="alert alert-warning">
						<h4>Instructions:</h4>
						<ol>
							<li>Fields with <b>*</b> are required.</li>
							<li>Edit the form correctly.</li>
							<li><b>Control Visibility</b> of the notice by checking/unchecking the checkbox</li>
							<li>Click <b>add page</b> when you are done.</li>
						</ol>
					</div>
				</div>

				<div class="col-md-8">
			        <div class="form-group">
			          	{{ Form::label('title', 'Title *') }}
			          	{{ Form::text('title', '', array('class' => 'form-control title')) }}
			          	{{ Form::error($errors, 'title') }}
			        </div>
			        
			        <div class="form-group">
			        	{{ Form::label('url', 'Url *') }}
			        	<div class="input-group">
					      	<span class="input-group-addon"> {{ Url::route('home') }}/</span>
					      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
					    </div>
					    {{ Form::error($errors, 'url') }}
			        </div>

			        <div class="form-group">
			          	{{ Form::label('content', 'Content *') }}
			          	{{ Form::textarea('content', '', array('class' => 'form-control', 'id' => 'editor')) }}
			          	{{ Form::error($errors, 'content') }}
			        </div>

			        <div class="form-group">
				        <div class="checkbox">
						    <label>
								{{ Form::checkbox('is_public', '1', true) }} This Page is visible publicly
						    </label>
					  	</div>
					</div>
		        	
		        	{{ Form::submit('Add Page', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
		        </div>

			{{ Form::close() }}
		</div>
	</div>


	
@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			// gets slug/url
			$('.title').on('input', function() {
				$.post("{{ URL::route('admin.pages.generateUrl')}}", { title: $(this).val() })
				  	.done(function(slug) {
				    	$('.url').val(slug);
				});
			});

			CKEDITOR.replace('editor', {
		    	filebrowserUploadUrl: "{{ URL::to('upload')}}",
		    	"extraPlugins": "imagebrowser",
        		"imageBrowser_listUrl": "{{ URL::to('list')}}"
		    });

		});
	</script>
@stop