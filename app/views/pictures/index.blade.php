@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.pictures.add') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Add New Picture
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Picture</th>
					<th>Public?</th>
					<th>Created By</th>
					<th>Caption</th>
					<th>Album</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pictures as $picture)
					<tr>
						<td>{{ HTML::image(URL::to("uploads/album_pictures/thumbnail_{$picture->file_url}"))  }}</td>
						<td>
							@if($picture->is_public)
								<span class="glyphicon glyphicon-ok text-success"></span>
							@else
								<span class="glyphicon glyphicon-remove text-danger"></span>
							@endif
						</td>
						<td>{{ $picture->user->full_name }}</td>
						<td>
							<a href="{{ URL::route('admin.pictures.show', $picture->url) }}" target="_blank">{{ $picture->caption }}</a>
						</td>
						<td>{{ HTML::link(URL::route('admin.albums.show', $picture->album->url), $picture->album->name) }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.pictures.show', array('url' => $picture->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.pictures.edit', array('url' => $picture->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteAlbumId="{{ $picture->id }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $pictures->links() }}</div>
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
					Are you sure to delete this picture?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.pictures.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

	<script type="text/javascript">
	$(document).ready(function() {
		
		// delete a batch
		$('.deleteBtn').click(function() {
			var deleteAlbumId = $(this).attr('deleteAlbumId');
			var url = "<?php echo URL::route('admin.pictures'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteAlbumId);
		});

	});
	</script>

@stop