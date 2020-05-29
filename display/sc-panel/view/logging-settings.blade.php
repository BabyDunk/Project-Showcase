<?php
/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 01:59
 */


?>

@extends('extends.admin-base')

@section('title', 'Logging')

@section('page-id', 'logging-settings')

@section('content')
    <div id="page-wrapper">


        <!-- Page Heading -->
        <div class="grid-x">
            <div class="large-12">
                <h1 class="page-header">
                    Settings
                    <small>Logging Settings</small>
                </h1>
                @include('includes.messages')
            </div>
            <div class="large-12">
                <form method="POST" action="/sc-panel/logging_settings" enctype="multipart/form-data">
                    <input type="hidden" id="CSRFToken" name="CSRFToken"
                           value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                    <div class="grid-container full">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-12 cell">
                                <fieldset class="fieldset">
                                    <legend>Error logging</legend>


                                    <div class="switch">
                                        <input class="switch-input" type="checkbox" name="errorlogging" id="errorlogging" value="1" <?php echo (!empty(sca_get_preference('showcase', 'sca_errorlogging'))) ? 'checked' : ''; ?>/>
                                        <label class="switch-paddle" for="errorlogging">
                                            <span class="show-for-sr">Enable Error Logging</span>
                                            <span class="switch-active" aria-hidden="true">Yes</span>
                                            <span class="switch-inactive" aria-hidden="true">No</span>
                                        </label>
                                    </div>

                                </fieldset>
                                <button class="success button expanded" type="submit" name="submit" id="submit"
                                        value="true">Submit!
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="large-12">

            </div>

        </div>
    </div>
    <!-- /#page-wrapper -->

@endsection
