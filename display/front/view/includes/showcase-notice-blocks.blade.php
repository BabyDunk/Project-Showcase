<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 22/06/2018
	 * Time: 13:19
	 */

	$theeBlockNotice = (object)unserialize(\Classes\Core\Showcase::find_by_id($id['id'])->three_notice_block);

	//var_dump($theeBlockNotice);

	?>

@if(!isset($theeBlockNotice->scalar))
<div id="info-1">
    <!-- Page Content -->
    <div class="grid-container">
        <div class="grid-container">
            <div class="grid-x grid-padding-x">
                <div class="grid-x grid-margin-x text-center" data-equalizer data-equalize-on="medium" id="test-eq">
                    <div class="cell medium-4 large-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4">{{$theeBlockNotice->blocknoticetitle1}}</h4>
                            </div>
                            <div class="card-image">
                                <i style="color: {{$theeBlockNotice->blocknotice_colorselector1}}" class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon1}} text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4>{{$theeBlockNotice->blocknoticesubtitle1}}</h4>
                                <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip1); @endphp</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell medium-4  large-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4">{{$theeBlockNotice->blocknoticetitle2}}</h4>
                            </div>
                            <div class="card-image">
                                <i style="color: {{$theeBlockNotice->blocknotice_colorselector2}}" class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon2}} text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4>{{$theeBlockNotice->blocknoticesubtitle2}}</h4>
                                <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip2); @endphp</p>
                            </div>
                        </div>
                    </div>
                    <div class="cell medium-4  large-4">
                        <div class="card" data-equalizer-watch>
                            <div class="card-divider">
                                <h4 class="h4">{{$theeBlockNotice->blocknoticetitle3}}</h4>
                            </div>
                            <div class="card-image">
                                <i style="color: {{$theeBlockNotice->blocknotice_colorselector3}}" class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon3}} text-center"></i>
                            </div>
                            <div class="card-section">
                                <h4>{{$theeBlockNotice->blocknoticesubtitle3}}</h4>
                                <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip3); @endphp</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

