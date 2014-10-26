@extends($layout)

@section('content')
	<div class="col-md-12">
		@if($layout == 'layouts.default')
			<div class="page-header">
				<h3>{{ $title }}</h3>
			</div>
		@endif
      	<p>{{ $page->content }}</p>
    </div>
@stop