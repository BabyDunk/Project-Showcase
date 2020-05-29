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

@section('title', 'Email Settings')

@section('page-id', 'email-settings')

@section('content')
    <div id="page-wrapper">


            <!-- Page Heading -->
            <div class="grid-x">
                <div class="large-12">
                    <h1 class="page-header">
                        Settings
                        <small>Email Settings</small>
                    </h1>
                    @include('includes.messages')
                </div>
                <div class="large-6">
                   <form method="POST" action="/sc-panel/email_settings" enctype="multipart/form-data">
                        <input type="hidden" id="CSRFToken" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <input type="hidden" name="emailauth" value="0">
                        <div class="grid-container full">
                            <div class="grid-x grid-padding-x">
                                <div class="medium-12 cell">
                                    <fieldset class="fieldset">
                                        <legend>Email Server Settings</legend>
                                        <label for="emailtitle">Title To Appear On Email</label>
                                        <input class="form-control" type="text" name="emailtitle" id="emailtitle" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailtitle'))) ? sca_get_preference('showcase', 'sca_emailtitle') : ''; ?>" placeholder="Title to display on email" />

                                        <label for="emailname">Name Too Appear On Email</label>
                                        <input class="form-control" type="text" name="emailname" id="emailname" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailname'))) ? sca_get_preference('showcase', 'sca_emailname') : ''; ?>" placeholder="Name to display on email" />

                                        <label for="emailserver">Email Server Name</label>
                                        <input class="form-control" type="text" name="emailserver" id="emailserver" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailserver'))) ? sca_get_preference('showcase', 'sca_emailserver') : ''; ?>" placeholder="Email server address eg; smtp.google.com" />

                                        <label for="emailgateway">Email Gateway Address</label>
                                        <input class="form-control" type="email" name="emailgateway" id="emailgateway" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailgateway'))) ? sca_get_preference('showcase', 'sca_emailgateway') : ''; ?>" placeholder="Email address to use for sending websites notifications" />

                                        <label for="emailgatewaypass">Email Gateway Password</label>
                                        <input class="form-control" type="password" name="emailgatewaypass" id="emailgatewaypass" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailgatewaypass'))) ? sca_get_preference('showcase', 'sca_emailgatewaypass') : ''; ?>" placeholder="Password email gateway" />

                                        <label for="emailserverport">Server Port<small><em> eg; 25</em></small></label>
                                        <input class="form-control" type="text" name="emailserverport" id="emailserverport" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_emailserverport'))) ? sca_get_preference('showcase', 'sca_emailserverport') : ''; ?>" placeholder="Server port number" />

                                        <label for="emailencryption">Encryption Type <small><em> eg; Leave blank, tls, ssl</em></small></label>
                                         <select class="form-control" type="text" name="emailencryption" id="emailencryption">
                                            <option value=""></option>
                                            <option value="tls" <?php echo (!empty(sca_get_preference('showcase', 'sca_emailencryption')) && sca_get_preference('showcase', 'sca_emailencryption') === 'tls') ? 'selected' : ''; ?>>TLS</option>
                                            <option value="ssl" <?php echo (!empty(sca_get_preference('showcase', 'sca_emailencryption')) && sca_get_preference('showcase', 'sca_emailencryption') === 'ssl') ? 'selected' : ''; ?>>SSL</option>
                                        </select>
                                        <fieldset class="fieldset">
                                            <legend>Enable SMTP Authentication</legend>

                                            <div class="switch">
                                                <input class="switch-input" type="checkbox" name="emailauth" id="emailauth" value="1" <?php echo (!empty(sca_get_preference('showcase', 'sca_emailauth'))) ? 'checked' : ''; ?>/>
                                                <label class="switch-paddle" for="emailauth">
                                                    <span class="show-for-sr">Enable SMTP Authentication</span>
                                                    <span class="switch-active" aria-hidden="true">Yes</span>
                                                    <span class="switch-inactive" aria-hidden="true">No</span>
                                                </label>
                                            </div>

                                        </fieldset>

                                        <fieldset class="fieldset">
                                            <legend>Debugging Mode</legend>

                                            <!-- Using radio buttons – each switch turns off the other two -->
                                            <div class="switch large">
                                                <input class="switch-input" id="email_debuggerRadioSwitch1" type="radio" value="0" name="email_debugger"  <?php echo (empty(sca_get_preference('showcase', 'sca_email_debugger'))) ? 'checked' : ''; ?> >
                                                <label class="switch-paddle" for="email_debuggerRadioSwitch1">
                                                    <span class="show-for-sr">Turn Email debugging off</span>
                                                    <span class="switch-active" aria-hidden="true">OFF</span>
                                                    <span class="switch-inactive" aria-hidden="true">ON</span>
                                                </label>
                                            </div>

                                            <div class="switch large">
                                                <input class="switch-input" id="email_debuggerRadioSwitch2" type="radio" value="1" name="email_debugger" <?php echo (!empty(sca_get_preference('showcase', 'sca_email_debugger'))  && sca_get_preference('showcase', 'sca_email_debugger') === 1) ? 'checked' : ''; ?> >
                                                <label class="switch-paddle" for="email_debuggerRadioSwitch2">
                                                    <span class="show-for-sr">Turn email debugging on for client notification</span>
                                                    <span class="switch-active" aria-hidden="true">Client</span>
                                                    <span class="switch-inactive" aria-hidden="true">OFF</span>
                                                </label>
                                            </div>

                                            <div class="switch large">
                                                <input class="switch-input" id="email_debuggerRadioSwitch3" type="radio"  value="2" name="email_debugger" <?php echo (!empty(sca_get_preference('showcase', 'sca_email_debugger'))  && sca_get_preference('showcase', 'sca_email_debugger') === 2) ? 'checked' : ''; ?> >
                                                <label class="switch-paddle" for="email_debuggerRadioSwitch3">
                                                    <span class="show-for-sr">Turn email debugging on for client and server notifications</span>
                                                    <span class="switch-active" aria-hidden="true">Server</span>
                                                    <span class="switch-inactive" aria-hidden="true">OFF</span>
                                                </label>
                                            </div>

                                            <h4><small>*Client: activate client debugging mode</small></h4>
                                            <h4><small>*Server: activate server & client debugging mode</small></h4>

                                            <label for="testemailaddess">Test Recipient<small><em> eg; Email address to send the test to.</em></small></label>
                                            <input class="form-control" type="text" name="testemailaddess" id="testemailaddess" value="<?php echo (!empty(sca_get_preference('showcase', 'sca_testemailaddess'))) ? sca_get_preference('showcase', 'sca_testemailaddess') : ''; ?>" placeholder="Email encryption type" />


                                        </fieldset>

                                        <label for="emailsignature">Email Signature</label>
                                        <textarea class="form-control" name="emailsignature" id="emailsignature" placeholder="Describe in short what we do here" ><?php echo (!empty(sca_get_preference('showcase', 'sca_emailsignature'))) ? sca_get_preference('showcase', 'sca_emailsignature') : ''; ?></textarea>
                                    </fieldset>
                                    <button  class="success button expanded" type="submit" name="submit" id="submit" value="true" >Submit!</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="large-6">
                    <form method="POST" action="/sc-panel/email_test_message" >
                        <input type="hidden" id="CSRFToken" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                        <fieldset class="fieldset">
                            <legend>Email Send Testing</legend>

                            <button id="sendtestemailaddess" class="button warning">Send Test Message</button>
                        </fieldset>
                    </form>
                    @if(\Classes\Core\Session::has('EMAIL_DEBUGGING'))
                    <textarea id="">
                        {{\Classes\Core\Session::get('EMAIL_DEBUGGING')}}
                        @php \Classes\Core\Session::clear('EMAIL_DEBUGGING') @endphp
                    </textarea>
                    @endif
                </div>
            </div>
            <!-- /.grid-x -->


    </div>
    <!-- /#page-wrapper -->

@endsection
