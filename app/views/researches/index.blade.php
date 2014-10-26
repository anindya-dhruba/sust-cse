@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.researches.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New Research
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>URL</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($researches as $research)
					<tr>
						<td>{{ $research->name }}</td>
						<td>
							<a href="{{ URL::route('researches.show', $research->url) }}">
								{{ $research->url }}
							</a>
						</td>
						<td>{{ Str::limit(strip_tags($research->description), 70, '...') }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.researches.show', array('url' => $research->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.researches.edit', array('url' => $research->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteId="{{ $research->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $researches->links() }}</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="deleteConfirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h4 class="modal-title" id="myModalLabel">Confirmation</h4>
		      	</div>
		      	<div class="modal-body">
					Are you sure to delete this research topic?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.researches.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a page
		$('.deleteBtn').click(function() {
			var deleteId = $(this).attr('deleteId');
			var url = "<?php echo URL::route('admin.researches'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteId);
		});

	});
	</script>

@stop