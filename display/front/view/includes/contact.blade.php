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
    <div class="grid-container">
        <div class="grid-container full">
            <div class="grid-x grid-padding-x">
                <div class="medium-5 cell">
                    <h4 class="text-center">{{sca_get_preference('showcase', 'sca_contacttitle')}}</h4>
                    <p><?php echo sca_get_preference('showcase', 'sca_contactdescription'); ?></p>
                </div>
                <div class="medium-2 cell">
                    <div class="grid-y grid-padding-y">
                        <div class="contact-arrow">
                            <i class="fa fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
                <div class="medium-5 cell">{{\Classes\Core\Contact::echo_form()}}</div>
            </div>
        </div>
    </div>
</div>
