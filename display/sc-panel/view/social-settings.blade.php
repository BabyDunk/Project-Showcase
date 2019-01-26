<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */


	?>

@extends('extends.admin-base')

@section('title', 'Social Settings')

@section('page-id', 'settings')

@section('content')
    <div id="page-wrapper">


            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Settings
                        <small>Social Settings</small>
                    </h1>
                    @if(isset($message))
                        <h2 class="bg-info">
                            {{$message}}
                        </h2>
                    @endif
                    @if(\Classes\Core\Session::has('MESSAGE'))
                        <h2 class="bg-info">
                            {{\Classes\Core\Session::get('MESSAGE')}}
                        </h2>
                    @endif
                    <h2 class="bg-warning">
                        @if(isset($error))
                            @foreach ( $error as $err)
                                {{$err}}<br>;
                            @endforeach
                        @endif
                    </h2>

                    <form method="POST" action="/sc-panel/social_settings" enctype="multipart/form-data">
                        <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <input type="hidden" name="fb_enabler" value="0"/>
                        <div class="grid-container full">
                            <div class="grid-x grid-padding-x">
                                <div class="medium-6 cell">
                                    <fieldset class="fieldset">
                                        <legend>Facebook Automatic Uploader</legend>
                                        <label for="fb_app_id">Application ID</label>
                                        <input class="form-control" type="text" name="fb_app_id" id="fb_app_id" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_fb_app_id'))) ? sca_get_preference('showcase', 'sca_fb_app_id') : ''; ?>" placeholder="Give this website a name" />

                                        <label for="fb_app_secret">App Secret</label>
                                        <input class="form-control" type="text" name="fb_app_secret" id="fb_app_secret" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_fb_app_secret'))) ? sca_get_preference('showcase', 'sca_fb_app_secret') : ''; ?>" placeholder="Give this website a url" />

                                        <label for="fb_page_id">Page ID</label>
                                        <input class="form-control" type="text" name="fb_page_id" id="fb_page_id" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_fb_page_id'))) ? sca_get_preference('showcase', 'sca_fb_page_id') : ''; ?>" placeholder="Give this website a title" />

                                        <label for="fb_post_message">Post Message</label>
                                        <textarea class="form-control" name="fb_post_message" id="fb_post_message" placeholder="Describe in full what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_fb_post_message'))) ? sca_get_preference('showcase', 'sca_fb_post_message') : ''; ?></textarea>

                                        <fieldset class="fieldset">
                                            <legend>Enable Facebook Automatic Uploads</legend>
                                            <div class="switch">
                                                <input class="switch-input" id="fb_enabler" type="checkbox" value="1" name="fb_enabler" <?php echo (!empty(sca_get_preference('showcase', 'sca_fb_enabler'))) ? 'checked' : ''; ?>>
                                                <label class="switch-paddle" for="fb_enabler">
                                                    <span class="show-for-sr">Check to enable to auto uploads</span>
                                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                                </label>
                                            </div>

                                        </fieldset>

                                        <fieldset class="fieldset">
                                            <legend>Default Image</legend>
                                            <label for="fb_default_img" class="button">Upload File</label>
                                            <input type="file" id="fb_default_img" name="fb_default_img" class="show-for-sr">
                                            <small class="medium-12 cell-block-container">This image is used when there is no image associated to the listing.</small>
                                        </fieldset>
                                    </fieldset>
                                    <button  class="success button expanded" type="submit" name="submit" id="submit" value="true" >Submit!</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
            <!-- /.grid-x -->


    </div>
    <!-- /#page-wrapper -->

@endsection
