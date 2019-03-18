<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 18/06/2018
	 * Time: 23:54
	 */

	$featured_imgs = \Classes\Core\Showcase::find_all_for_feature( sca_get_preference( 'showcase' , 'sca_howmanyfrontfeaturedimg' ) , 'desc' );


?>

<div id="feature-slider">
    <!-- Page Content -->
    <div class="container">
        @if(!empty($featured_imgs))
            <div class="js-Carousel" id="featured-carousel">
                <ul>
                    @foreach($featured_imgs as $featured_img)
                        @if(!empty($featured_img->filename))
                            <li>
                                <figure class="carousel-figure">
                                    <img class="carousel-image split-12"
                                         src="{{$featured_img->picture_url()}}" alt="{{$featured_img->title}}">
                                    <figcaption class="carousel-caption"><a
                                                href="/shop/showcase/{{$featured_img->id}}/{{urlString($featured_img->title)}}">{{$featured_img->title}}</a>
                                    </figcaption>
                                </figure>
                            </li>
                        @endif
                    @endforeach

                </ul>
            </div>
        @endif
    </div>
</div>
