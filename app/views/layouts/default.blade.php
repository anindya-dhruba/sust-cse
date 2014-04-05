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
        
        <div class="container">
            <div class="row">
                
                <div class="col-md-9">
                    @yield('content')
                </div>
            </div>
            <hr/>
            <div class="footer text-right">
                &copy;copyright {{ date('Y') }}
            </div>
        </div>
    </body>
</html>
