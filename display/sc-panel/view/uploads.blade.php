<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */

	if(isset($id['id'])){
	$showcase =	\Classes\Core\Showcase::find_by_id($id['id']);

	$showcasePins = \Classes\Core\ShowcasePins::find_by_show_id($showcase->show_id);

	$paymentMethod = [];
	if(!empty($showcase->showcasePayment)){
		$paymentMethod = unserialize($showcase->showcasePayment);
    }

    $threeBlockNotice = (object)unserialize($showcase->three_notice_block);

    }



	$fonts = new Awps\FontAwesome();

	$fontAwesome = $fonts->getAllData();

	?>

@extends('extends.admin-base')

@section('title', 'Uploads')

@section('page-id', 'uploads')

@include('includes.reveal')

@section('content')
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Upload
                        <small>Share A Showcase</small>
                    </h1>
                    @include('includes.messages')

                    <form method="POST" action="/sc-panel/uploads" enctype="multipart/form-data">
                        <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <input type="hidden" name="tempID" id="tempID" value="<?php echo (!empty($showcase->show_id)) ? $showcase->show_id : \Classes\Core\Hashing::instance()->show_id(); ?>"/>
                        <input type="hidden" name="showcaseId" id="showcaseId" value="<?php echo (!empty($showcase->id)) ? $showcase->id : ''; ?>"/>
                        <div class="grid-container full">
                            <div class="grid-x grid-margin-x">
                                <div class="medium-12 cell">
                                    <label for="title">Give your showcase a Title
                                        <input class="form-control" type="text" name="title" id="title" value="<?php echo (!empty($showcase->title)) ? $showcase->title : (empty($_POST['title'])) ? $_POST['title'] :''; ?>" placeholder="Give your Image a Title" />
                                    </label>

                                    <label for="subtitle">Give your showcase a Subtitle
                                        <input class="form-control" type="text" name="subtitle" id="subtitle" value="<?php echo (!empty($showcase->subtitle)) ? $showcase->subtitle : (empty($_POST['subtitle'])) ? $_POST['subtitle'] : ''; ?>" placeholder="Give your showcase a Subtitle" />
                                    </label>

                                    <fieldset class="fieldset">
                                        <legend>
                                            Monetise
                                        </legend>

                                        <ul class="accordion" data-accordion>
                                            <li class="accordion-item <?php echo ($showcase->job_deposit) ? '' : 'is-active'; ?>" data-accordion-item>
                                                <!-- Accordion tab title -->
                                                <a href="#" class="accordion-title">Fixed Price</a>

                                                <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
                                                <div class="accordion-content" data-tab-content>
                                                    <label for="price">Price
                                                        <input class="form-control" type="number" step=".01" name="price" id="price" value="<?php echo (!empty($showcase->price)) ? sca_show_price($showcase->price) : (empty($_POST['price'])) ? $_POST['price'] : ''; ?>" placeholder="Set items value in &pound;" />
                                                    </label>
                                                </div>
                                            </li>
                                            <li class="accordion-item <?php echo ($showcase->job_deposit) ? 'is-active' : '' ; ?>" data-accordion-item>
                                                <!-- Accordion tab title -->
                                                <a href="#" class="accordion-title">Quoted Price</a>

                                                <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
                                                <div class="accordion-content" data-tab-content>
                                                    <label for="job_deposit">Deposit
                                                        <input class="form-control" type="number" name="job_deposit" id="job_deposit" value="<?php echo (!empty($showcase->job_deposit)) ? $showcase->job_deposit : (empty($_POST['job_deposit'])) ? $_POST['job_deposit'] : ''; ?>" placeholder="Set the deposit value in &pound;" />
                                                    </label>

                                                    <label for="job_duration">Job duration in days
                                                        <input class="form-control" type="number" name="job_duration" id="job_duration" value="<?php echo (!empty($showcase->job_duration)) ? $showcase->job_duration : (empty($_POST['job_duration'])) ? $_POST['job_duration'] : ''; ?>" placeholder="Set number of days for the duration of the job." />
                                                    </label>

                                                    <fieldset class="fieldset">
                                                        <legend>Payment Methods</legend>
                                                        <label>Multiple Select Menu
                                                            <select multiple name="showcasePayment[]" id="showcasePayment">
                                                                <option value="cash" <?php echo (!empty($paymentMethod) && in_array("cash", $paymentMethod) ? 'selected="selected"' : (empty($_POST['cash'])) ? 'selected' : ''); ?>>Cash</option>
                                                                <option value="paypal" <?php echo (!empty($paymentMethod) && in_array("paypal", $paymentMethod) ? 'selected="selected"' : (empty($_POST['paypal'])) ? 'selected' : ''); ?>>Paypal</option>
                                                                <option value="card" <?php echo (!empty($paymentMethod) && in_array("card", $paymentMethod) ? 'selected="selected"' : (empty($_POST['card'])) ? 'selected' : ''); ?>>Card</option>
                                                                <option value="bitcoin" <?php echo (!empty($paymentMethod) && in_array("bitcoin", $paymentMethod) ? 'selected="select' : (empty($_POST['bitcoin'])) ? 'selected' : ''); ?>>Bitcoin</option>
                                                            </select>
                                                        </label>
                                                    </fieldset>
                                                </div>
                                            </li>

                                        </ul>
                                    </fieldset>


                                    <label for="description1">Description <small>Will be visible if the showcase is featured</small>
                                        <textarea class="form-control" name="description1" id="description1" placeholder="Describe your showcase" ><?php echo (!empty($showcase->description1)) ? $showcase->description1 :  (empty($_POST['description1'])) ? $_POST['description1'] : ''; ?></textarea>
                                    </label>

                                    <!-- 3 Block Notice Field -->
                                    <fieldset class="fieldset" id="threeblocknotice">
                                        <legend>3 Block Notice</legend>
                                        <div class="grid-x grid-padding-x">
                                            <div class="medium-4 cell">
                                                <label for="blocknoticetitle1">Title
                                                    <input name="blocknoticetitle1" id="blocknoticetitle1" type="text" placeholder="Give this block a title" value="{{!empty($threeBlockNotice->blocknoticetitle1) ? $threeBlockNotice->blocknoticetitle1 : (empty($_POST['blocknoticetitle1'])) ? $_POST['blocknoticetitle1'] :  ''}}"/>
                                                </label>
                                                <label for="blocknoticefaicon1">Icon
                                                    <select name="blocknoticefaicon1" id="blocknoticefaicon1">
                                                        @foreach($fontAwesome as $font)

                                                            @if($font['class'] === $threeBlockNotice->blocknoticefaicon1)
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @elseif($font['class'] === $_POST['blocknoticefavicon1'])
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @else
                                                                <option value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="blocknotice_colorselector1-placement">Select foreground color
                                                    <a href="#" id="blocknotice_colorselector1-placement" class="button" data-preselectedcolor="<?php echo (!empty($threeBlockNotice->blocknotice_colorselector1)) ? $threeBlockNotice->blocknotice_colorselector1 : (empty($_POST['blocknotice_colorselector1'])) ? $_POST['blocknotice_colorselector1'] : ''; ?>">Select Color</a>

                                                    <input type="hidden" name="blocknotice_colorselector1" id="blocknotice_colorselector1" value="{{!empty($threeBlockNotice->blocknotice_colorselector1) ? $threeBlockNotice->blocknotice_colorselector1 : (empty($_POST['blocknotice_colorselector1'])) ? $_POST['blocknotice_colorselector1'] : ''}}"  />
                                                </label>

                                                <label for="blocknoticesubtitle1">Subtitle
                                                    <input name="blocknoticesubtitle1" id="blocknoticesubtitle1" type="text" placeholder="Give this block a subtitle" value="{{!empty($threeBlockNotice->blocknoticesubtitle1) ? $threeBlockNotice->blocknoticesubtitle1 : (empty($_POST['blocknoticesubtitle1'])) ? $_POST['blocknoticesubtitle1'] : ''}}"/>
                                                </label>
                                                <label for="blocknoticedescrip1">Description
                                                    <textarea name="blocknoticedescrip1" id="blocknoticedescrip1"  placeholder="Give this block a short description">{{!empty($threeBlockNotice->blocknoticedescrip1) ? $threeBlockNotice->blocknoticedescrip1 : (empty($_POST['blocknoticedescrip1'])) ? $_POST['blocknoticedescrip1'] : ''}}</textarea>
                                                </label>
                                            </div>
                                            <div class="medium-4 cell">
                                                <label for="blocknoticetitle2">Title
                                                    <input name="blocknoticetitle2" id="blocknoticetitle2" type="text" placeholder="Give this block a title" value="{{!empty($threeBlockNotice->blocknoticetitle2) ? $threeBlockNotice->blocknoticetitle2 : (empty($_POST['blocknoticetitle2'])) ? $_POST['blocknoticetitle2'] :  ''}}"/>
                                                </label>
                                                <label for="blocknoticefaicon2">Icon
                                                    <select name="blocknoticefaicon2" id="blocknoticefaicon2">
                                                        @foreach($fontAwesome as $font)

                                                            @if($font['class'] === $threeBlockNotice->blocknoticefaicon2)
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @elseif($font['class'] === $_POST['blocknoticefavicon2'])
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @else
                                                                <option value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="blocknotice_colorselector2-placement">Select foreground color
                                                    <a href="#" id="blocknotice_colorselector2-placement" class="button" data-preselectedcolor="<?php echo (!empty($threeBlockNotice->blocknotice_colorselector2)) ? $threeBlockNotice->blocknotice_colorselector2 : (empty($_POST['blocknotice_colorselector2'])) ? $_POST['blocknotice_colorselector2'] : ''; ?>">Select Color</a>

                                                    <input type="hidden" name="blocknotice_colorselector2" id="blocknotice_colorselector2" value="{{!empty($threeBlockNotice->blocknotice_colorselector2) ? $threeBlockNotice->blocknotice_colorselector2 : (empty($_POST['blocknotice_colorselector2'])) ? $_POST['blocknotice_colorselector2'] : ''}}"  />
                                                </label>

                                                <label for="blocknoticesubtitle2">Subtitle
                                                    <input name="blocknoticesubtitle2" id="blocknoticesubtitle2" type="text" placeholder="Give this block a subtitle" value="{{!empty($threeBlockNotice->blocknoticesubtitle2) ? $threeBlockNotice->blocknoticesubtitle2 : (empty($_POST['blocknoticesubtitle2'])) ? $_POST['blocknoticesubtitle2'] : ''}}"/>
                                                </label>
                                                <label for="blocknoticedescrip2">Description
                                                    <textarea name="blocknoticedescrip2" id="blocknoticedescrip2"  placeholder="Give this block a short description">{{!empty($threeBlockNotice->blocknoticedescrip2) ? $threeBlockNotice->blocknoticedescrip2 : (empty($_POST['blocknoticedescrip2'])) ? $_POST['blocknoticedescrip2'] : ''}}</textarea>
                                                </label>
                                            </div>
                                            <div class="medium-4 cell">
                                                <label for="blocknoticetitle3">Title
                                                    <input name="blocknoticetitle3" id="blocknoticetitle3" type="text" placeholder="Give this block a title" value="{{!empty($threeBlockNotice->blocknoticetitle3) ? $threeBlockNotice->blocknoticetitle3 : (empty($_POST['blocknoticetitle3'])) ? $_POST['blocknoticetitle3'] :  ''}}"/>
                                                </label>
                                                <label for="blocknoticefaicon3">Icon
                                                    <select name="blocknoticefaicon3" id="blocknoticefaicon3">
                                                        @foreach($fontAwesome as $font)

                                                            @if($font['class'] === $threeBlockNotice->blocknoticefaicon1)
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @elseif($font['class'] === $_POST['blocknoticefavicon1'])
                                                                <option selected value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @else
                                                                <option value="{{$font['class']}}" >&#x{{ltrim($font['unicode'], '\/')}}; - {{$font['name']}}</option>
                                                            @endif

                                                        @endforeach
                                                    </select>
                                                </label>

                                                <label for="blocknotice_colorselector3-placement">Select foreground color
                                                    <a href="#" id="blocknotice_colorselector3-placement" class="button" data-preselectedcolor="<?php echo (!empty($threeBlockNotice->blocknotice_colorselector3)) ? $threeBlockNotice->blocknotice_colorselector3 : (empty($_POST['blocknotice_colorselector3'])) ? $_POST['blocknotice_colorselector3'] : ''; ?>">Select Color</a>

                                                    <input type="hidden" name="blocknotice_colorselector3" id="blocknotice_colorselector3" value="{{!empty($threeBlockNotice->blocknotice_colorselector3) ? $threeBlockNotice->blocknotice_colorselector3 : (empty($_POST['blocknotice_colorselector3'])) ? $_POST['blocknotice_colorselector3'] : ''}}"  />
                                                </label>

                                                <label for="blocknoticesubtitle3">Subtitle
                                                    <input name="blocknoticesubtitle3" id="blocknoticesubtitle3" type="text" placeholder="Give this block a subtitle" value="{{!empty($threeBlockNotice->blocknoticesubtitle3) ? $threeBlockNotice->blocknoticesubtitle3 : (empty($_POST['blocknoticesubtitle3'])) ? $_POST['blocknoticesubtitle3'] : ''}}"/>
                                                </label>
                                                <label for="blocknoticedescrip3">Description
                                                    <textarea name="blocknoticedescrip3" id="blocknoticedescrip3"  placeholder="Give this block a short description">{{!empty($threeBlockNotice->blocknoticedescrip3) ? $threeBlockNotice->blocknoticedescrip3 : (empty($_POST['blocknoticedescrip3'])) ? $_POST['blocknoticedescrip3'] : ''}}</textarea>
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>

                                    <!-- Pin Field -->
                                    <fieldset class="fieldset">
                                        <legend>Information Pins</legend>

                                        <div id="pin-notification"></div>

                                            <label for="information_pin_title">Pin Title
                                                <input type="text"  id="information_pin_title" placeholder="Give pin a title" />
                                            </label>

                                            <label for="information_pin_body">Pin Body
                                                <textarea class="form-control" id="information_pin_body" placeholder="Create a showcase pin eg; snippet of info concerning the showcase." ></textarea>
                                            </label>

                                            <div class="information_pins">
                                                @if(!empty($showcasePins))
                                                    @foreach($showcasePins as $item)

                                                        <div class="reveal" id="editPin-{{$item->id}}" data-reveal data-animation-in="scale-in-up">
                                                            <form >
                                                                <fieldset class="fieldset">
                                                                    <legend>Edit this pin</legend>

                                                                    <input type="text" id="pinTitle-{{$item->id}}" value="{{$item->show_title}}" placeholder="Give this pin a title" />
                                                                    <textarea  id="pinBody-{{$item->id}}"  placeholder="Create a showcase pin eg; snippet of info concerning the showcase." >@php echo !empty($item->show_body) ? allowedTags($item->show_body) : '' @endphp</textarea>
                                                                </fieldset>

                                                                <input type="submit"
                                                                       class="button success expanded editPin"
                                                                       data-showid="{{$id['id']}}"
                                                                       data-pinid="{{$item->id}}"
                                                                       data-csrftoken="{{\Classes\Core\CSRFToken::_SetToken()}}"
                                                                       value="Update Pin">

                                                            </form>
                                                            <button class="close-button" data-close aria-label="Close modal" type="button">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <div class="reveal" id="deletePin-{{$item->id}}" data-reveal data-animation-in="scale-in-up">
                                                            <div class="notification"></div>
                                                            <h3 class="h3">Do you want to delete pin - <small>{{$item->show_title}}</small>?</h3>

                                                            <div class="button-group float-right">
                                                                <form >
                                                                    <input type="submit"
                                                                           class="button warning deletePin"
                                                                           data-showid="{{$id['id']}}"
                                                                           data-pinid="{{$item->id}}"
                                                                           data-csrftoken="{{\Classes\Core\CSRFToken::_SetToken()}}"
                                                                           value="Delete">
                                                                </form>
                                                                <a class="button primary" aria-label="Close modal" data-close>Close</a>

                                                            </div>

                                                            <button class="close-button" data-close aria-label="Close modal" type="button">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>

                                                        <fieldset class="fieldset" id="insertedPin-{{$item->id}}">
                                                            <legend>Inserted Pins: <span id="insertedPinTitle-{{$item->id}}">{{$item->show_title}}</span></legend>
                                                            <div class="card">
                                                                <div class="callout">
                                                                    <span id="insertedPinBody-{{$item->id}}"><?php echo allowedTags($item->show_body); ?></span>
                                                                </div>
                                                            </div>
                                                            <div class="button-group float-right">
                                                                <a  class="button primary" data-open="editPin-{{$item->id}}">Edit</a>
                                                                <a class="button warning" data-open="deletePin-{{$item->id}}">Delete</a>
                                                            </div>
                                                        </fieldset>

                                                    @endforeach
                                                @endif

                                            </div>

                                        <button class="button primary float-right" value="true" id="information_pin_button">Set Pin</button>
                                    </fieldset>

                                    <!-- Color Field -->
                                    <fieldset class="fieldset">
                                        <legend>Color Selection</legend>
                                        <div class="grid-x grid-padding-x">
                                            <div class="medium-6 cell">
                                                <label for="bg_colorselector-placement">Select background color</label>
                                                <a href="#" id="bg_colorselector-placement" class="button" data-preselectedcolor="<?php echo (!empty($showcase->bg_colorselector)) ? $showcase->bg_colorselector : (empty($_POST['bg_colorselector'])) ? $_POST['bg_colorselector'] :''; ?>">Select Color</a>
                                                <input type="hidden" name="bg_colorselector" id="bg_colorselector" value="<?php echo (!empty($showcase->bg_colorselector)) ? $showcase->bg_colorselector : (empty($_POST['bg_colorselector'])) ? $_POST['bg_colorselector'] : ''; ?>" />
                                            </div>
                                        </div>

                                        <div class="grid-x grid-padding-x">
                                            <div class="medium-6 cell">
                                                <label for="fg_colorselector-placement">Select foreground color</label>
                                                <a href="#" id="fg_colorselector-placement" class="button" data-preselectedcolor="<?php echo (!empty($showcase->fg_colorselector)) ? $showcase->fg_colorselector : (empty($_POST['fg_colorselector'])) ? $_POST['fg_colorselector'] : ''; ?>">Select Color</a>
                                                <input  type="hidden" name="fg_colorselector" id="fg_colorselector" value="<?php echo (!empty($showcase->fg_colorselector)) ? $showcase->fg_colorselector : (empty($_POST['fg_colorselector'])) ? $_POST['fg_colorselector'] : ''; ?>" />
                                            </div>
                                        </div>
                                    </fieldset>

                                    <fieldset class="fieldset">
                                        <legend>Set A Featured Image</legend>
                                        <div class="medium-6">
                                            <label for="upload_file" class="button">Select your feature image</label>
                                            <input type="file" name="upload_file" id="upload_file" class="show-for-sr">
                                            <small>Featured image dimension should be 1200px x 600px</small>
                                        </div>

                                        @if(!empty($showcase->filename))
                                        <div class="medium-6">
                                            <img class="thumbnail" src="<?php echo $showcase->get_picture() ?>" />
                                        </div>
                                        @endif
                                    </fieldset>

                                    <fieldset class="fieldset">
                                        <legend>Upload Showcase Images</legend>
                                        <div class="callout warning">

                                        </div>
                                    </fieldset>

                                    <fieldset class="fieldset">
                                        <legend>Demo Links</legend>
                                        <div class="grid-x grid-padding-x">
                                            <div class="large-12 cell">
                                                <label for="frontDemo">Frontend demo url
                                                    <input type="url" id="frontDemo" name="frontDemo" value="@php  echo (!empty($showcase->front_demo_link)) ? $showcase->front_demo_link : (empty($_POST['front_demo_link'])) ? $_POST['front_demo_link'] : '';  @endphp" placeholder="Enter link eg; https://frontend-demo.com">
                                                </label>
                                                <label for="backDemo">Admin demo url
                                                    <input type="url" id="backDemo" name="backDemo" value="@php  echo (!empty($showcase->back_demo_link)) ? $showcase->back_demo_link : (empty($_POST['back_demo_link'])) ? $_POST['back_demo_link'] : '';  @endphp" placeholder="Enter link eg; https://backend-demo.com">
                                                </label>
                                            </div>
                                            <div class="medium-6 large-6 cell">
                                                <label for="backDemoUser">Demo admin username
                                                    <input type="text" id="backDemoUser" name="backDemoUser" value="@php  echo (!empty($showcase->back_demo_user)) ? $showcase->back_demo_user : (empty($_POST['back_demo_user'])) ? $_POST['back_demo_user'] : '';  @endphp" placeholder="Enter link eg; https://backend-demo.com">
                                                </label>
                                            </div>
                                            <div class="medium-6 large-6 cell">
                                                <label for="backDemoPass">Demo admin password
                                                    <input type="text" id="backDemoPass" name="backDemoPass" value="@php  echo (!empty($showcase->back_demo_pass)) ? $showcase->back_demo_pass : (empty($_POST['back_demo_pass'])) ? $_POST['back_demo_pass'] : '';  @endphp" placeholder="Enter link eg; https://backend-demo.com">
                                                </label>
                                            </div>
                                        </div>
                                    </fieldset>


                                    <button class="button success expanded"  type="submit" name="submit" id="submit" value="true" >Submit!</button>

                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

@endsection
