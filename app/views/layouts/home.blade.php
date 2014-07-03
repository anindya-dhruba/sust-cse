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
		{{ HTML::style("css/bootstrap-theme.css") }}
		{{ HTML::style('css/datepicker.css') }}
		{{ HTML::style('http://netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css') }}
		{{ HTML::style("css/custom.css") }}
		@yield('style')

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/datepicker.js') }}
    	{{ HTML::script('js/custom.js') }}
    	@yield('script')
    </head>
	
	<body>
		<div class="container">
			@include('includes.topNavAdmin')
			@include('includes.topNav')
			<div class="row">
				@include('includes.sideNav')
				<div class="col-md-9">
					@include('includes.slider')
				</div>
				<div class="col-md-3">
					<div class="panel panel-success">
						<div class="panel-heading">Recent Notices</div>

						<div class="list-group">
							@foreach (Helper::recentNotices() as $key => $notice)
								<a href="{{ URL::route('notices.show', $notice->url) }}" class="list-group-item">
									<h5 class="list-group-item-heading"><strong>{{ $notice->title }}</strong></h5>
									<p class="list-group-item-text">
										{{ Str::limit(strip_tags($notice->notice), 100) }}
									</p>
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
