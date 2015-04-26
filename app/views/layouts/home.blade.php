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
		@include('includes.slider')

		@include('includes.topNavAdmin')
		@include('includes.topNav')
		<div class="container">
			<div class="row">
				<!-- home page content -->
	            <div class="col-md-12 space">
	            	<div class="row">
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
					
						<!-- recent news -->
						<div class="col-md-4">
							<div class="panel panel-success vspace">
								<div class="panel-heading">
									<i class="fa fa-thumb-tack"></i>
									Recent News
								</div>

								<div class="list-group">
									@foreach (Helper::recentNews() as $key => $news)
										<a href="{{ URL::route('news.show', $news->url) }}" class="list-group-item">
											<h5 class="list-group-item-heading"><strong>{{ $news->title }}</strong></h5>
											<small>
												{{ Helper::date($news->created_at) }}
											</small>
										</a>
									@endforeach
									<a href="{{ URL::route('news') }}" class="list-group-item">
										<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View All News</h5>
									</a>
								</div>
							</div>
						</div>

			            <!-- recent events -->
			            <div class="col-md-4">
							<div class="panel panel-success vspace">
								<div class="panel-heading">
									<i class="fa fa-map-marker"></i>
									Recent Events
								</div>

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

						<!-- recent researches -->
			            <div class="col-md-4">
							<div class="panel panel-success vspace">
								<div class="panel-heading">
									<i class="fa fa-lightbulb-o"></i>
									New Research Areas
								</div>

								<div class="list-group">
									@foreach (Helper::recentResearch() as $key => $research)
										<a href="{{ URL::route('researches.show', $research->url) }}" class="list-group-item">
											<h5 class="list-group-item-heading"><strong>{{ $research->name }}</strong></h5>
											<small>
												{{ count($research->users) }} user(s) researched
											</small>
										</a>
									@endforeach
									<a href="{{ URL::route('researches') }}" class="list-group-item">
										<h5 class="list-group-item-heading"><span class="glyphicon glyphicon-chevron-right"></span> View all Research Areas</h5>
									</a>
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
