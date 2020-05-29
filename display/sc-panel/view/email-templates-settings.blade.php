<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 28/05/2018
	 * Time: 01:59
	 */
//echo sca_get_preference('showcase', 'sca_user_request_info_notifier')
	?>

@extends('extends.admin-base')

@section('title', 'Email Templates')

@section('page-id', 'email-temp-settings')

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


                       <fieldset class="fieldset full">
                           <legend>Showcase Item Contact Notifier</legend>
                           <label for="sca_item_contact_notifier_title">Email Title</label>
                               <input type="text" class="form-control" name="sca_item_contact_notifier_title" id="sca_item_contact_notifier_title"
                                      placeholder="Give this email a title"
                                      value="@php echo  sca_get_preference('showcase', 'sca_item_contact_notifier_title') ? sca_get_preference('showcase', 'sca_item_contact_notifier_title') : '' @endphp"/>

                           <label for="sca_item_contact_notifier">
                               <small>Body of email - plain test or html</small>
                           </label>
                           <textarea class="form-control" name="sca_item_contact_notifier" id="sca_item_contact_notifier"
                                     cols="14" rows="7">@php echo  sca_get_preference('showcase', 'sca_item_contact_notifier') ? sca_get_preference('showcase', 'sca_item_contact_notifier') : '' @endphp</textarea>
                       </fieldset>


                       <fieldset class="fieldset full">
                           <legend>User Requested Information Notifier</legend>
                           <label>Email Title
                               <input type="text" class="form-control" name="sca_user_request_info_notifier_title"
                                      id="sca_user_request_info_notifier_title" placeholder="Give this email a title"
                                      value="@php echo  sca_get_preference('showcase', 'sca_user_request_info_notifier_title') ? sca_get_preference('showcase', 'sca_user_request_info_notifier_title') : '' @endphp"/>
                           </label>
                           <label for="sca_user_request_info_notifier">
                               <small>Body of email - plain test or html</small>
                           </label>
                           <textarea class="form-control" name="sca_user_request_info_notifier" id="sca_user_request_info_notifier"
                                     cols="14" rows="7">@php echo  sca_get_preference('showcase', 'sca_user_request_info_notifier') ? sca_get_preference('showcase', 'sca_user_request_info_notifier') : '' @endphp</textarea>
                       </fieldset>


                       <button type="submit" name="submit" class="button success expanded">Submit!</button>
                    </form>
                </div>
            </div>
            <!-- /.grid-x -->


    </div>
    <!-- /#page-wrapper -->

@endsection
