@extends('layouts.admin')

@section('content')
	<div class="col-md-12">
		<h3>
			{{ $title }}
			<a href="{{ URL::route('admin.batches.add') }}" class='btn btn-primary pull-right'>
				<span class="glyphicon glyphicon-plus"></span> Add New Batch
			</a>
		</h3>
		<hr/>

		@include('includes.alert')
		<table class="table table-bordered table-striped">
			<thead>
				<tr>
					<th>Name</th>
					<th>Year</th>
					<th colspan="3">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($batches as $batch)
					<tr>
						<td>{{ $batch->name }}</td>
						<td>{{ $batch->year }}</td>
						<td>
							<a href="{{ URL::route('admin.batches.show', array('year' => $batch->year)); }}" class='btn btn-success btn-sm'>
					        	<span class="glyphicon glyphicon-zoom-in"></span>
							</a>
						</td>
						<td>
	        				<a href="{{ URL::route('admin.batches.edit', array('year' => $batch->year)) }}" class='btn btn-warning btn-sm'>
	        					<span class="glyphicon glyphicon-edit"></span>
	        				</a>
	        			</td>
	        			<td>
	        				<a href="#" class="btn btn-danger btn-sm deleteBtn" data-toggle="modal" data-target="#deleteConfirm" deleteBatchYear="{{ $batch->year }}">
	        					<span class="glyphicon glyphicon-trash"></span>
	        				</a>
						</td>
					</tr>
				@endforeach
			</tbody>
		</table>

		<div class="text-center">{{ $batches->links() }}</div>
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
					Are you sure to delete this batch?
		      	</div>
		      	<div class="modal-footer">
		        	{{ Form::open(array('route' => array('admin.batches.delete', 0), 'method'=> 'delete', 'class' => 'deleteForm')) }}
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
			var deleteBatchYear = $(this).attr('deleteBatchYear');
			var url = "<?php echo URL::route('admin.batches'); ?>";
			$(".deleteForm").attr("action", url+'/'+deleteBatchYear);
		});

	});
	</script>

@stop