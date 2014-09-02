@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.albums') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-chevron-left"></span> View All Albums
			</a>
		</h3>
		<hr/>

		@include('includes.alert')

		<div class="row">
			{{ Form::open(array('route' => 'admin.albums.add')) }}

				<div class="col-md-4">
					<br/>
					<div class="alert alert-warning">
						<h4>Instructions:</h4>
						<ol>
							<li>Fields with <b>*</b> are required.</li>
							<li>Fill the form correctly.</li>
							<li><b>Control Visibility</b> of the album by checking/unchecking the checkbox</li>
							<li>Click <b>add album</b> when you are done.</li>
						</ol>
					</div>
				</div>

				<div class="col-md-8">
			        <div class="form-group">
			          	{{ Form::label('name', 'Album Name *') }}
			          	{{ Form::text('name', '', array('class' => 'form-control name')) }}
			          	{{ Form::error($errors, 'name') }}
			        </div>

			        <div class="form-group">
			        	{{ Form::label('url', 'Url *') }}
			        	<div class="input-group">
					      	<span class="input-group-addon"> {{ Url::route('home') }}/albums/</span>
					      	{{ Form::text('url', '', array('class' => 'form-control url')) }}
					    </div>
					    {{ Form::error($errors, 'url') }}
			        </div>			        

			        <div class="form-group">
			          	{{ Form::label('details', 'Album Details *') }}
			          	{{ Form::textarea('details', '', array('class' => 'form-control ckeditor')) }}
			          	{{ Form::error($errors, 'details') }}
			        </div>

			        <div class="form-group">
				        <div class="checkbox">
						    <label>
								{{ Form::checkbox('is_public', '1', true) }} This album is visible publicly
						    </label>
					  	</div>
					</div>
					{{ Form::submit('Add Album', array('class' => 'btn btn-primary', 'data-loading-text' => 'Adding...', 'type' => 'button')) }}
				</div>

			{{ Form::close() }}
		</div>
	</div>
@stop

	
@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			// gets url
			$('.name').on('input', function() {
				$.post("{{ URL::route('admin.albums.generateUrl')}}", { name: $(this).val() })
				  	.done(function(url) {
				    	$('.url').val(url);
				});
			});
		});
	</script>


@stop