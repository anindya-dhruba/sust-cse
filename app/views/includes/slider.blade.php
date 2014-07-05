<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!-- Indicators -->
	<ol class="carousel-indicators">
		@foreach(Helper::sliderPictures() as $key => $picture)
			<li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ ($key==0)? 'active':'' }}"></li>
		@endforeach
	</ol>
	
	<div class="carousel-inner">
		@foreach(Helper::sliderPictures() as $key => $picture)
			<div class="item {{ ($key==0)? 'active':'' }}">
				{{ HTML::image(URL::to("uploads/slider_images/$picture->file_url")) }}	
				<div class="carousel-caption">
					<h3>{{ $picture->caption }}</h3>
				</div>
			</div>
		@endforeach
	</div>
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div>