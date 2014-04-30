<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>{{ $title }} | {{ Config::get('myConfig.siteName') }} - {{ Config::get('myConfig.tagName') }}</title>

		{{ HTML::style("css/bootstrap.css") }}
		{{ HTML::style('css/bootstrap3-wysiwyg5.css') }}
		{{ HTML::style('css/datepicker.css') }}
		{{ HTML::style('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css') }}
		{{ HTML::style("css/custom.css") }}

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/datepicker.js') }}

		{{ HTML::script('js/wysihtml5-0.3.0.min.js') }}
		{{ HTML::script('js/bootstrap3-wysihtml5.js') }}

    	{{ HTML::script('js/custom.js') }}
    </head>
	
	<body>
		<div class="container">
			@include('includes.topNav')
			<div class="row">
				@include('includes.sideNav')
				<div class="col-md-9">
					@include('includes.slider')
				</div>
				<div class="col-md-3">
					<div class="panel panel-default">
					  	<div class="panel-heading">
					    	<h3 class="panel-title">Recent Notices</h3>
					  	</div>
					  	<div class="panel-body">
					    	@foreach (Helper::recentNotices() as $key => $notice)
					    		<a href="{{ URL::route('notices.show', $notice->url) }}">
					    			<strong>{{ $notice->title }}</strong><br/>
					    			{{ Str::limit(strip_tags($notice->notice), 100) }}
					    			<hr/>
					    		</a>
					    	@endforeach
					  	</div>
					</div>
				</div>
	            <div class="col-md-9">
	            	<div class="row">
	                	@yield('content')
	                </div>
	            </div>
            	@include('includes.footer')
            </div>
        </div>
    </body>
</html>
