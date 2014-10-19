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
		<link href='http://fonts.googleapis.com/css?family=Patua+One' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
		{{ HTML::style("css/custom.css") }}
		@yield('style')

		{{ HTML::script('js/jquery.min.js') }}
		{{ HTML::script('js/bootstrap.js') }}
		{{ HTML::script('js/datepicker.js') }}
    	{{ HTML::script('js/custom.js') }}
    	@yield('script')
    </head>
	
	<body>
	<div id="bg"></div>
		@include('includes.slider')

		<div class="container">
			@include('includes.topNavAdmin')
			@include('includes.topNav')
			<div class="row">

				<!-- home page content -->
	            <div class="col-md-12">
	            	<div class="row welcome-content">
	                	@yield('content')
	                </div>
	            </div>

				<!-- sidenav -->
				<div class="col-md-12">
					@include('includes.sideNav')
				</div>

				<!-- main content -->
				<div class="col-md-12 home-boxes">
					<div class="row">
						
						<div class="col-md-4">
							<!-- recent notices -->
							<div class="panel panel-success vspace">
								<div class="panel-heading">Lorem Ipsum</div>

								<div class="list-group">
									@foreach (Helper::recentNotices() as $key => $notice)
										<a href="{{ URL::route('notices.show', $notice->url) }}" class="list-group-item">
											<h5 class="list-group-item-heading"><strong>{{ $notice->title }}</strong></h5>
											<small>
												{{ Helper::date($notice->created_at) }}
											</small>
										</a>
									@endforeach
									<a href="{{ URL::route('notices') }}" class="list-group-item">
										<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View All Notices</h5>
									</a>
								</div>
							</div>
						</div>


						<div class="col-md-4">
							<!-- recent notices -->
							<div class="panel panel-success vspace">
								<div class="panel-heading">Recent Notices</div>

								<div class="list-group">
									@foreach (Helper::recentNotices() as $key => $notice)
										<a href="{{ URL::route('notices.show', $notice->url) }}" class="list-group-item">
											<h5 class="list-group-item-heading"><strong>{{ $notice->title }}</strong></h5>
											<small>
												{{ Helper::date($notice->created_at) }}
											</small>
										</a>
									@endforeach
									<a href="{{ URL::route('notices') }}" class="list-group-item">
										<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View All Notices</h5>
									</a>
								</div>
							</div>
						</div>

			            <!-- recent events -->
			            <div class="col-md-4">
							<div class="panel panel-success vspace">
								<div class="panel-heading">Recent Events</div>

								<div class="list-group">
									@foreach (Helper::recentEvents() as $key => $event)
										<a href="{{ URL::route('events.show', $event->url) }}" class="list-group-item">
											<h5 class="list-group-item-heading"><strong>{{ $event->title }}</strong></h5>
											<small>
												{{ Helper::date($event->start_date) }} - {{ Helper::date($event->end_date) }} :
												<mark>{{ Helper::daysDiff($event->start_date, $event->end_date) }} day</mark>
											</small>
										</a>
									@endforeach
									<a href="{{ URL::route('events') }}" class="list-group-item">
										<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View all Events</h5>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
				</div>
				</div>
		</div>
		
        @include('includes.footer')
    </body>
</html>
