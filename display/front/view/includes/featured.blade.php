<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 17/06/2018
	 * Time: 03:00
	 */


	$showcases = \Classes\Core\Showcase::find_all_for_feature( sca_get_preference( 'showcase' , 'sca_howmanyfrontfeatured' ) , 'desc' );


	$i = 0;
?>
@if(!empty($showcases))
    <div id="featured-items">
        <div class="container">
            <div class="featured-wrap">
                @foreach($showcases as $showcase)
                    @php
                        $i++;
                        $urlfriedlytitle = urlString($showcase->title);
                    @endphp
                    <div class="featured"
                         style="background-color: {{$showcase->bg_colorselector}}; border-color:{{$showcase->fg_colorselector}}">
                        <div class="flex-tri-inner">
                            <div class="cell">
                                <div class="image-featured">
                                    <a href="/shop/showcase/{{$showcase->id}}/{{$urlfriedlytitle}}"><img
                                                class="thumbnail" src="{{$showcase->get_picture()}}"/></a>
                                </div>
                                <div class="text-box">
                                    <h3>{{$showcase->title}}</h3>
                                    <p>@php echo allowedTags(trimString($showcase->description1, 70)); @endphp </p>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
