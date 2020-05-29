<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 22/06/2018
	 * Time: 13:19
	 */

	$theeBlockNotice = (object) unserialize( \Classes\Core\Showcase::find_by_id( $id[ 'id' ] )->three_notice_block );

	//var_dump($theeBlockNotice);

?>

@if(!isset($theeBlockNotice->scalar))
    <div id="info-1">
        <!-- Page Content -->
        <div class="container">
            <div class="triCard">
                <div class="card">
                    <div class="cardTitle">
                        <h3>{{$theeBlockNotice->blocknoticetitle1}}</h3>
                    </div>
                    <div class="cardImg">
                        <i style="color: {{$theeBlockNotice->blocknotice_colorselector1}}"
                           class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon1}} text-center"></i>
                    </div>
                    <div class="cardDes">
                        <h4>{{$theeBlockNotice->blocknoticesubtitle1}}</h4>
                        <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip1); @endphp</p>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTitle">
                        <h3>{{$theeBlockNotice->blocknoticetitle2}}</h3>
                    </div>
                    <div class="cardImg">
                        <i style="color: {{$theeBlockNotice->blocknotice_colorselector2}}"
                           class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon2}} text-center"></i>
                    </div>
                    <div class="cardDes">
                        <h4>{{$theeBlockNotice->blocknoticesubtitle2}}</h4>
                        <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip2); @endphp</p>
                    </div>
                </div>
                <div class="card">
                    <div class="cardTitle">
                        <h3>{{$theeBlockNotice->blocknoticetitle3}}</h3>
                    </div>
                    <div class="cardImg">
                        <i style="color: {{$theeBlockNotice->blocknotice_colorselector3}}"
                           class="fa fa-5x {{$theeBlockNotice->blocknoticefaicon3}} text-center"></i>
                    </div>
                    <div class="cardDes">
                        <h4>{{$theeBlockNotice->blocknoticesubtitle3}}</h4>
                        <p>@php echo allowedTags($theeBlockNotice->blocknoticedescrip3); @endphp</p>
                    </div>
                </div>
            </div><!-- End of tri box div -->
        </div>
    </div>
@endif

