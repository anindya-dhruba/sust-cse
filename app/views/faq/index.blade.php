@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.faqs.add') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Add New FAQ
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Question</th>
					<th>Answer</th>
					<th>Url</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($faqs as $faq)
					<tr>
						<td>{{ Str::limit(strip_tags($faq->question), 40, '...') }}</td>
						<td>{{ Str::limit(strip_tags($faq->answer), 80, '...') }}</td>
						<td>
							<a href="{{ URL::route('faqs') }}#{{ $faq->url }}">{{ $faq->url }}</a>
						</td>
						<td>
							<div class="btn-group">
								<a href="{{ URL::route('admin.faqs.show', array('pageUrl' => $faq->url)); }}" class='btn btn-default btn-sm'>
						        	<span class="glyphicon glyphicon-zoom-in"></span> View
								</a>
								<a href="{{ URL::route('admin.faqs.edit', array('pageUrl' => $faq->url)) }}" class='btn btn-default btn-sm'>
	        						<span class="glyphicon glyphicon-edit"></span> Edit
	        					</a>
	        					<a href="#" class="btn btn-default btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deletePageUrl="{{ $faq->url }}">
		        					<span class="glyphicon glyphicon-trash"></span> Delete
		        				</a>
	        				</div>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $faqs->links() }}</div>
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
					Are you sure to delete this FAQ?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.faqs.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var url = "<?php echo URL::route('admin.faqs'); ?>";
			$(".deleteForm").attr("action", url+'/'+deletePageUrl);
		});

	});
	</script>

@stop