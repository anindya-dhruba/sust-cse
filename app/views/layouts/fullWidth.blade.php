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
		{{ HTML::style("css/custom.css") }}

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/datepicker.js') }}
    	{{ HTML::script('js/custom.js') }}
    </head>
	
	<body>
        @include('includes.topNav')
        <div class="container">
            <div class="row">
                @yield('content')
            </div>
            @include('includes.footer')
        </div>
    </body>
</html>
