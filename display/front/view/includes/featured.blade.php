<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 17/06/2018
	 * Time: 03:00
	 */


	$showcases = \Classes\Core\Showcase::find_all_for_feature(sca_get_preference('showcase', 'sca_howmanyfrontfeatured'), 'desc');


$i = 0;
	?>

@foreach($showcases as $showcase)
	@php
		$i++;
		$urlfriedlytitle = urlString($showcase->title);
	@endphp
<div class="featured" style="background-color: {{$showcase->bg_colorselector}};">
    <div class="inner-featured">
        <div class="grid-container">
				<div class="grid-x grid-padding-x">
					@if($i % 2 != 0)
						<div class="medium-3 cell">
							<div class="image-featured">
								<img class="thumbnail" src="{{$showcase->get_picture()}}"/>
							</div>
							<ul>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
							</ul>
						</div>
						<div class="medium-9 callout">
							<h3>{{$showcase->title}}</h3>
							<h4>{{$showcase->subtitle}}</h4>
							<p><?php echo allowedTags($showcase->description1); ?> </p>
						</div>
					@else
						<div class="medium-9 cell" >
							<h3>{{$showcase->title}}</h3>
							<h4>{{$showcase->subtitle}}</h4>
							<p><?php echo allowedTags($showcase->description1); ?> </p>
						</div>
						<div class="medium-3 cell">
							<div class="image-featured">
								<img class="thumbnail" src="{{$showcase->get_picture()}}"/>
							</div>
							<ul>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
								<li><a href="/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}" >View</a></li>
							</ul>
						</div>
					@endif
				</div>
        </div>
    </div>
</div>
@endforeach
