@extends('layouts.default')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('notices.add') }}" class='btn btn-primary btn-sm pull-right' style="vertical-align: middle;">
					<span class="glyphicon glyphicon-plus"></span> Add New Notice
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Title</th>
					<th>Url</th>
					<th>Content</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($notices as $notice)
					<tr>
						<td>{{ $notice->title }}</td>
						<td>{{ $notice->url }}</td>
						<td>{{ Str::limit(strip_tags($notice->notice), 80, '...') }}</td>
						<td>
							<a href="{{ URL::route('notices.show', array('pageUrl' => $notice->url)); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
						<td>
	        				<a href="{{ URL::route('notices.edit', array('pageUrl' => $notice->url)) }}" class='btn btn-warning btn-sm'>
	        					<span class="glyphicon glyphicon-edit"></span>
	        				</a>
	        			</td>
	        			<td>
	        				<a href="#" class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deletePageUrl="{{ $notice->url }}">
	        					<span class="glyphicon glyphicon-trash"></span>
	        				</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $notices->links() }}</div>
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
					Are you sure to delete this notice?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('notices.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var deletePageUrl = $(this).attr('deletePageUrl');
			var url = "<?php echo URL::route('notices'); ?>";
			$(".deleteForm").attr("action", url+'/'+deletePageUrl);
		});

	});
	</script>

@stop