@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.pages.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New Page
				</a>
			</h3>
		</div>

		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Public?</th>
					<th>Updated On</th>
					<th>Title</th>
					<th>Content</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($pages as $page)
					<tr>
						<td>
							@if($page->is_public)
								<span class="glyphicon glyphicon-ok text-success"></span>
							@else
								<span class="glyphicon glyphicon-remove text-danger"></span>
							@endif
						</td>
						<td>{{ Helper::date($page->updated_at) }}</td>
						<td>
							<a href="{{ URL::to($page->url) }}" target="_blank">{{ $page->title }}</a>
						</td>
						<td>{{ Str::limit(strip_tags($page->content), 70, '...') }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.pages.show', array('url' => $page->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								@if($page->can_update)
			        				<a href="{{ URL::route('admin.pages.edit', array('url' => $page->url)) }}" class='btn btn-default btn-sm'>
			        					<span class="glyphicon glyphicon-edit"></span> Edit
			        				</a>
			        			@else
			        				<a href="{{ URL::route('admin.pages.edit', array('url' => $page->url)) }}" class='btn btn-default btn-sm disabled'>
			        					<span class="glyphicon glyphicon-edit"></span> Edit
			        				</a>
			        			@endif
			        			@if($page->can_delete)
		        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deletePageUrl="{{ $page->url }}">
		        						<span class="glyphicon glyphicon-trash"></span> Delete
		        					</a>
		        				@else
		        					<a href="#" class="btn btn-default btn-sm deleteBtn disabled" data-toggle="modal" data-target="#deleteConfirm" deletePageUrl="{{ $page->url }}">
		        						<span class="glyphicon glyphicon-trash"></span> Delete
		        					</a>
		        				@endif
							</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $pages->links() }}</div>
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
					Are you sure to delete this page?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.pages.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
		        		<button type="button" class="btn btn-danger" data-dismiss="modal">No</button>
		        		{{ Form::submit('Yes, Delete', array('class' => 'btn btn-success')) }}
		        	{{ Form::close() }}
		      	</div>
	    	</div>
		</div>
	</div>

@stop

@section('script')
	<script type="text/javascript">
		$(document).ready(function() {
			// delete a page
			$('.deleteBtn').click(function() {
				var deletePageUrl = $(this).attr('deletePageUrl');
				var url = "<?php echo URL::route('admin.pages'); ?>";
				$(".deleteForm").attr("action", url+'/'+deletePageUrl);
			});

		});
	</script>
@stop