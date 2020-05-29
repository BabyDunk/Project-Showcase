<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 12/06/2018
	 * Time: 23:36
	 */

	?>

<div id="contact">
    <!-- Page Content -->
    <div class="container" id="contact-div">
        <div class="flex-tri-inner">
            <div class="split-5 cell center-text">
                <h4 class="text-center">{{ (sca_get_preference('showcase', 'sca_contacttitle')) ? sca_get_preference('showcase', 'sca_contacttitle') : '' }}</h4>
                <p>@php echo (sca_get_preference('showcase', 'sca_contactdescription')) ? sca_get_preference('showcase', 'sca_contactdescription') : ''; @endphp</p>
            </div>
            <div class="split-2 cell center-text">
                <div class="arrow-contain">
                    <div class="contact-arrow">
                        <i class="fa fa-arrow-right"></i>
                    </div>
                </div>
            </div>
            <div class="split-5 cell ">{{\Classes\Core\Contact::echo_form()}}</div>
        </div>
    </div>
</div>
