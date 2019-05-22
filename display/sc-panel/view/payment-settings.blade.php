<?php
/**
 * Created by Chris Wilkinson.
 * Title: oop
 * Date: 28/05/2018
 * Time: 01:59
 */


?>

@extends('extends.admin-base')

@section('title', 'Payment Settings')

@section('page-id', 'payment-settings')

@section('content')
    <div id="page-wrapper">


        <!-- Page Heading -->
        <div class="grid-x">
            <div class="large-12">
                <h1 class="page-header">
                    Settings
                    <small>General Settings</small>
                </h1>
                @include('includes.messages')

                <form method="POST" action="/sc-panel/payment_settings" enctype="multipart/form-data">
                    <input type="hidden" name="CSRFToken" value="<?php echo \Classes\Core\CSRFToken::_SetToken(); ?>"/>
                    <div class="grid-container full">
                        <div class="grid-x grid-padding-x">
                            <div class="medium-6">

                                <fieldset class="fieldset">
                                    <legend>General Payment Settings</legend>

                                    <label for="currencyType">Currency Type</label>
                                    <input class="form-control" type="text" name="currencyType"
                                           id="currencyType"
                                           value="<?php echo  sca_has_preference( 'showcase' , 'sca_currencyType' )   ? sca_get_preference( 'showcase' , 'sca_currencyType' ) : ''; ?>"
                                           placeholder="Provide a three-letter currency ISO code eg; GBP"/>

                                </fieldset>
                                <ul class="accordion" data-accordion>
                                    <li class="accordion-item is-active" data-accordion-item>
                                        <!-- Accordion tab title -->
                                        <a href="#" class="accordion-title"><i class="fa fa-cc-stripe"></i> Stripe</a>

                                        <div class="accordion-content" data-tab-content>
                                            <fieldset class="fieldset full">
                                                <legend>Stripe Gateway Settings</legend>


                                                <fieldset class="fieldset">
                                                    <legend>Live or Test Mode</legend>

                                                    <!-- Using radio buttons – each switch turns off the other two -->
                                                    <div class="switch large">
                                                        <input class="switch-input" id="sca_stripeLiveOrTest1"
                                                               type="radio" value="0"
                                                               name="stripe_mode" <?php echo ( empty( sca_get_preference( 'showcase' , 'sca_stripe_mode' ) ) ) ? 'checked' : ''; ?> >
                                                        <label class="switch-paddle" for="sca_stripeLiveOrTest1">
                                                            <span class="show-for-sr">Turn Email debugging off</span>
                                                            <span class="switch-active" aria-hidden="true">TEST</span>
                                                            <span class="switch-inactive" aria-hidden="true">LIVE</span>
                                                        </label>
                                                    </div>

                                                    <div class="switch large">
                                                        <input class="switch-input" id="sca_stripeLiveOrTest2"
                                                               type="radio" value="1"
                                                               name="stripe_mode" <?php echo ( ! empty( sca_get_preference( 'showcase' , 'sca_stripe_mode' ) ) && sca_get_preference( 'showcase' , 'sca_stripe_mode' ) === 1 ) ? 'checked' : ''; ?> >
                                                        <label class="switch-paddle" for="sca_stripeLiveOrTest2">
                                                            <span class="show-for-sr">Turn email debugging on for client notification</span>
                                                            <span class="switch-active" aria-hidden="true">LIVE</span>
                                                            <span class="switch-inactive" aria-hidden="true">TEST</span>
                                                        </label>
                                                    </div>


                                                    <h4>
                                                        <small>* Double check everything before switching to live mode.
                                                            eg; secret and publishable keys present and correct
                                                        </small>
                                                    </h4>
                                                    <h4>
                                                        <small>* Double check your have activated your stripe account
                                                            before going live
                                                        </small>
                                                    </h4>

                                                </fieldset>

                                                <fieldset class="fieldset">
                                                    <legend>Live Mode Credentials</legend>

                                                    <label for="livePubKey">Publishable Key</label>
                                                    <input class="form-control" type="text" name="livePubKey"
                                                           id="livePubKey"
                                                           value="<?php echo (   sca_has_preference( 'showcase' , 'sca_livePubKey' ) ) ? sca_get_preference( 'showcase' , 'sca_livePubKey' ) : ''; ?>"
                                                           placeholder="Enter the live publishable key here"/>

                                                    <label for="liveSecretKey">Secret Key</label>
                                                    <input class="form-control" type="password" name="liveSecretKey"
                                                           id="liveSecretKey"
                                                           value="<?php echo (  sca_has_preference( 'showcase' , 'sca_liveSecretKey' ) ) ? sca_get_preference( 'showcase' , 'sca_liveSecretKey' ) : ''; ?>"
                                                           placeholder="Give this website a url"/>


                                                </fieldset>
                                                <fieldset class="fieldset">
                                                    <legend>Test Mode Credentials</legend>


                                                    <label for="testPubKey">Publishable Key</label>
                                                    <input class="form-control" type="text" name="testPubKey"
                                                           id="livePubtestPubKeyKey"
                                                           value="<?php echo ( sca_has_preference( 'showcase' , 'sca_testPubKey' ) ) ? sca_get_preference( 'showcase' , 'sca_testPubKey' ) : ''; ?>"
                                                           placeholder="Enter the live publishable key here"/>

                                                    <label for="testSecretKey">Secret Key</label>
                                                    <input class="form-control" type="password" name="testSecretKey"
                                                           id="testSecretKey"
                                                           value="<?php echo  sca_has_preference( 'showcase' , 'sca_testSecretKey' )   ? sca_get_preference( 'showcase' , 'sca_testSecretKey' ) : ''; ?>"
                                                           placeholder="Give this website a url"/>


                                                </fieldset>
                                            </fieldset>
                                        </div>
                                    </li>
                                    <li class="accordion-item" data-accordion-item>
                                        <!-- Accordion tab title -->
                                        <a href="#" class="accordion-title"><i class="fa fa-cc-paypal"></i> Paypal</a>

                                        <!-- Accordion tab content: it would start in the open state due to using the `is-active` state class. -->
                                        <div class="accordion-content" data-tab-content>
                                            <fieldset class="fieldset full">
                                                <legend>Paypal Gateway Settings</legend>

                                               <p>Paypal Placeholder</p>
                                            </fieldset>
                                        </div>
                                    </li>
                                    <!-- ... -->
                                </ul>
                                <button class="success button expanded" type="submit" name="submit" id="submit"
                                        value="true">Submit!
                                </button>
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
