@extends('layouts.admin')

@section('content')
	<div class="col-md-12">	
		<div class="page-header">
			<h3>
				{{ $title }}
				<a href="{{ URL::route('admin.news.add') }}" class='btn btn-primary pull-right'>
					<span class="glyphicon glyphicon-plus"></span> Add New News
				</a>
			</h3>
		</div>
		@include('includes.alert')
		<table class="table table-responsive table-bordered table-striped">
			<thead>
				<tr>
					<th>Public?</th>
					<th>Updated On</th>
					<th>Created By</th>
					<th>Title</th>
					<th>Content</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($news as $singleNews)
					<tr>
						<td>
							@if($singleNews->is_public)
								<span class="glyphicon glyphicon-ok text-success"></span>
							@else
								<span class="glyphicon glyphicon-remove text-danger"></span>
							@endif
						</td>
						<td>{{ Helper::date($singleNews->updated_at) }}</td>
						<td>
							{{ $singleNews->user->last_name }}, {{ $singleNews->user->first_name }} {{ $singleNews->user->middle_name }}
						</td>
						<td>
							<a href="{{ URL::route('news.show', $singleNews->url) }}" target="_blank">{{ $singleNews->title }}</a>
						</td>
						<td>{{ Str::limit(strip_tags($singleNews->news), 50, '...') }}</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.news.show', array('url' => $singleNews->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.news.edit', array('url' => $singleNews->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deletePageUrl="{{ $singleNews->url }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $news->links() }}</div>
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
					Are you sure to delete this news?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.news.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var url = "<?php echo URL::route('admin.news'); ?>";
			$(".deleteForm").attr("action", url+'/'+deletePageUrl);
		});

	});
	</script>

@stop