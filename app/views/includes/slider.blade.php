<?php $sliderPictures = Helper::sliderPictures(); ?>

@if(count($sliderPictures))
	<div id="myCarousel" class="carousel slide" data-ride="carousel">
		<!-- Indicators -->
		{{--<ol class="carousel-indicators">--}}
			{{--@foreach($sliderPictures as $key => $picture)--}}
				{{--<li data-target="#myCarousel" data-slide-to="{{ $key }}" class="{{ ($key==0)? 'active':'' }}"></li>--}}
			{{--@endforeach--}}
		{{--</ol>--}}

		<div class="carousel-inner">
			@foreach($sliderPictures as $key => $picture)
				<div class="item {{ ($key==0)? 'active':'' }}">
					{{ HTML::image(URL::to("uploads/slider_images/$picture->file_url")) }}
					<div class="carousel-caption">
						<h2>{{ $picture->caption }}</h2>
					</div>
				</div>
			@endforeach
		</div>
	</div>
@endif

 {{--<div class="shadow"></div>--}}