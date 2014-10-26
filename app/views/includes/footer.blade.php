<footer>
	<div class="container">
		<div class="row footer">
			<div class="col-md-3">
				<img class="footer-img" src="{{URL::to('img/logo_footer.png')}}">
			</div>
		
			<div class="col-md-3">
				<h3>SUST.EDU</h3>
				<ul>
					<li>
						<a href="http://www.sust.edu/"><i class="fa fa-home"></i> Home</a>
					</li>
					<li>
						<a href="http://www.sust.edu/map"><i class="fa fa-globe"></i> Map</a>
					</li>
					<li>
						<a href="http://www.sust.edu/news"><i class="fa fa-calendar"></i> News</a>
					</li>
					<li>
						<a href="http://www.sust.edu/events"><i class="fa fa-th-large"></i> Events</a>
					</li>
					<li>
						<a href="http://www.sust.edu/downloads"><i class="fa fa-download"></i> Downloads</a>
					</li>
					<li>
						<a href="http://www.sust.edu/contact"><i class="fa fa-envelope"></i> Contact</a>
					</li>
				</ul>
			</div>
			<div class="col-md-3">
				<h3>SUST CSE</h3>
				<ul>
					@foreach (Helper::getPublicPages('side') as $key => $menu)
						<li>
							<a href="{{ URL::to($menu->page->url) }}">
								<span class="icon fa {{ $menu->page_icon }}"></span> {{ $menu->page->title }}
							</a>
						</li>
			        @endforeach
				</ul>
			</div>
			<div class="col-md-3">
				<h3>SOCIAL NETWORKS</h3>
				<ul>
					<li>
						<a href="#"><i class="fa fa-facebook-square"></i> Facebook</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-twitter-square"></i> Twitter</a>
					</li>
					<li>
						<a href="#"><i class="fa fa-google-plus-square"></i> Google Plus</a>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<div class="footer-copyright text-center">
		&copy;All rights reserved by <a href="{{ URL::route('home') }}">Dept. of Computer Science &amp; Engineering</a><br/><a href="http://www.sust.edu">Shahjalal University of Science &amp; Technology</a>, Sylhet, Bangladesh, {{ date('Y') }}. [<a href="#" data-toggle="modal" data-target="#developers">Developers</a>]
	</div>
</footer>


<div class="modal fade" id="developers" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static">
	  	<div class="modal-dialog">
	    	<div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		        	<h2 class="modal-title" id="myModalLabel">Developers</h2>
		      	</div>
		      	<div class="modal-body">
					<div class="list-group">
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Anindya Dhruba</h4>
							<p class="list-group-item-text">
								2010331013, 19th Batch,<br/>
								anindya DOT dhruba AT gmail DOT com</p>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Ashraful Prium</h4>
							<p class="list-group-item-text">
								2010331057, 19th Batch,<br/>
								prium47 AT gmail DOT com</p>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Abu Shahriar Ratul</h4>
							<p class="list-group-item-text">
								2010331016, 19th Batch,<br/>
								... AT gmail DOT com</p>
						</a>
						<a href="#" class="list-group-item">
							<h4 class="list-group-item-heading">Yousuf Khan Ratul</h4>
							<p class="list-group-item-text">
								2010331020, 19th Batch,<br/>
								... AT gmail DOT com</p>
						</a>
					</div>
		      	</div>
		      	<div class="modal-footer">
					<a href="#" class="btn btn-success btn-sm" data-dismiss="modal">Close</a>
		      	</div>
	    	</div>
		</div>
	</div>