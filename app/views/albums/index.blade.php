@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.albums.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New Album
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Public?</th>
					<th>Created By</th>
					<th>Name</th>
					<th>Description</th>
					<th>#Photos</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($albums as $album)
					<tr>
						<td>
							@if($album->is_public)
								<span class="glyphicon glyphicon-ok text-success"></span>
							@else
								<span class="glyphicon glyphicon-remove text-danger"></span>
							@endif
						</td>
						<td>{{ $album->user->last_name.", ".$album->user->first_name." ".$album->user->middle_name }}</td>
						<td>
							<a href="{{ URL::route('albums.show', $album->url) }}" target="_blank">{{ $album->name }}</a>
						</td>
						<td>{{ Str::limit(strip_tags($album->details), 50, '...') }}</td>
						<td>{{ $album->pictures->count() }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.albums.show', array('url' => $album->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.albums.edit', array('url' => $album->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteAlbumId="{{ $album->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $albums->links() }}</div>
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
					Are you sure to delete this album? This will also delete all the pictures of this album.
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.albums.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete an album
		$('.deleteBtn').click(function() {
			var deleteAlbumId = $(this).attr('deleteAlbumId');
			var url = "<?php echo URL::route('admin.albums'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteAlbumId);
		});

	});
	</script>

@stop