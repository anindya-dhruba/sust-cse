@extends('layouts.default')

@section('content')
	<div class="col-md-12">

      	<div class="panel-group" id="accordion">

      		@foreach ($faqs as $faq)
				<div class="panel panel-default">
					<div class="panel-heading">
				  		<h4 class="panel-title">
				    		<a data-toggle="collapse" data-parent="#accordion" href="#{{ $faq->url }}">
				      			{{ $faq->question }}
				    		</a>
				  		</h4>
					</div>
					<div id="{{ $faq->url }}" class="panel-collapse collapse">
				  		<div class="panel-body"> {{ nl2br($faq->answer) }}</div>
					</div>
				</div>
			@endforeach
    	</div>
    </div>

    <script type="text/javascript">
    	$(document).ready(function() {
		    var anchor = window.location.hash.replace("#", "");
		    $("#"+anchor).collapse('show');
		});
    </script>
@stop