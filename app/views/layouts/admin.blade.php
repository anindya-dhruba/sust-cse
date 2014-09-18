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
			<div class="row">
	            <div class="col-md-12">
	            	<div class="row">
	                	@yield('content')
	                </div>
	            </div>
            	@include('includes.footer')
            </div>
        </div>
    </body>
</html>
