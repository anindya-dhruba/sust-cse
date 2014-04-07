<?php 
    $publicPages = Menu::getPublicPages();
?>

<div class="col-md-3">
	<div class="list-group">
        @foreach ($publicPages as $key => $publicPage)
            <a href="{{ URL::to($publicPage->url) }}" class="list-group-item">
                {{ $publicPage->title }}
            </a>
        @endforeach
	</div>

	<div class="list-group">
		<a href="#" class="list-group-item">
		    Faculty
		</a>
		<a href="#" class="list-group-item">
		    Stuff
		</a>
		<a href="#" class="list-group-item">
		    Students
		</a>
	</div>
</div>