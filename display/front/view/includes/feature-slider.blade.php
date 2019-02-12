<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 18/06/2018
	 * Time: 23:54
	 */

	$featured_imgs = \Classes\Core\Showcase::find_all_for_feature(sca_get_preference('showcase', 'sca_howmanyfrontfeaturedimg'), 'desc');


	?>

<div id="feature-slider">
    <!-- Page Content -->
    <div class="grid-container">
        <div class="grid-container full">
            <div class="grid-x grid-padding-x">
                <div class="orbit large-12 medium-12 small-12" role="region" aria-label="Feature item picture" data-orbit>
                    <div class="orbit-wrapper">
                        <div class="orbit-controls">
                            <button class="orbit-previous"><span class="show-for-sr">Previous Slide</span>&#9664;&#xFE0E;</button>
                            <button class="orbit-next"><span class="show-for-sr">Next Slide</span>&#9654;&#xFE0E;</button>
                        </div>
                        <ul class="orbit-container">

                            @foreach($featured_imgs as $featured_img)
                                @if(!empty($featured_img->filename))
                                <li class="orbit-slide">
                                    <figure class="orbit-figure">
                                        <img class="orbit-image {{--featured-img--}}" src="{{$featured_img->picture_url()}}" alt="{{$featured_img->title}}">
                                        <figcaption class="orbit-caption"><a href="/showcase/{{$featured_img->id}}/{{urlString($featured_img->title)}}">{{$featured_img->title}}</a></figcaption>
                                    </figure>
                                </li>
                                @endif
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
