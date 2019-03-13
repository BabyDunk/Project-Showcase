<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */

	//\Classes\Core\Email::testMail();

	?>

@extends('extends.admin-base')

@section('title', 'Email Templates')

@section('page-id', 'settings')

@section('content')
    <div id="page-wrapper">


            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Settings
                        <small>Email Templates</small>
                    </h1>
                    @include('includes.messages')
                </div>
                <div class="large-12">
                   <form method="POST" action="/sc-panel/email_templates_settings" enctype="multipart/form-data">
                        <input type="hidden" id="CSRFToken" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <fieldset class="fieldset">
                            <legend>Showcase Item Contact Notifier</legend>
                            <input name="sca_item_contact_notifier_title" id="sca_item_contact_notifier_title" placeholder="Give this email a title" value="@php echo  sca_get_preference('showcase', 'sca_item_contact_notifier_title') ? sca_get_preference('showcase', 'sca_item_contact_notifier_title') : '' @endphp"/>
                            <textarea name="sca_item_contact_notifier" id="sca_item_contact_notifier"  cols="14">@php echo  sca_get_preference('showcase', 'sca_item_contact_notifier') ? sca_get_preference('showcase', 'sca_item_contact_notifier') : '' @endphp</textarea>
                        </fieldset>


                       <button type="submit" name="submit" class="button success expanded">Submit!</button>
                    </form>
                </div>
            </div>
            <!-- /.grid-x -->


    </div>
    <!-- /#page-wrapper -->

@endsection
