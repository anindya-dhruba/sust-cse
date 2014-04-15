<!DOCTYPE html>
<html lang="en">
  	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">

		<title>{{ $title }} | {{ Config::get('myConfig.siteName') }}</title>

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
		@include('includes.topNav')
		<div class="container">
            <div class="row">
                @include('includes.sideNav')
                <div class="col-md-9">
                	<div class="row">
                    	@yield('content')
                    </div>
                </div>
            </div>
            @include('includes.footer')
        </div>
    </body>
</html>
