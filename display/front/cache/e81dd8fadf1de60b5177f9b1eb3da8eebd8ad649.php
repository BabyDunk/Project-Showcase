<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: showcase_app
	 * Date: 18/06/2018
	 * Time: 23:55
	 */
	?>


<div id="text-slider">
    <!-- Page Content -->
    <div class="grid-container">
        <div class="grid-container full">
            <div class="grid-x grid-padding-x">
                <div class="medium-8 medium-offset-2">
                    <div class="orbit" role="region" aria-label="What we do" data-orbit>
                        <ul class="orbit-container text-center">
                            <button class="orbit-previous" aria-label="previous"><span class="show-for-sr">Previous Slide</span>&#9664;</button>
                            <button class="orbit-next" aria-label="next"><span class="show-for-sr">Next Slide</span>&#9654;</button>
                            <li class="is-active orbit-slide info-1-color-1">
                                <div class="callout">
                                    <?php echo sca_get_preference('showcase', 'sca_frontinfoslider1'); ?>
                                </div>
                            </li>
                            <li class="orbit-slide info-1-color-2">
                                <div class="callout">

                                    <?php echo sca_get_preference('showcase', 'sca_frontinfoslider2'); ?>
                                </div>
                            </li>
                            <li class="orbit-slide info-1-color-3">
                                <div class="callout">
                                    <?php echo sca_get_preference('showcase', 'sca_frontinfoslider3'); ?>
                                </div>
                            </li>
                            <li class="orbit-slide info-1-color-4">
                                <div class="callout">
                                    <?php echo sca_get_preference('showcase', 'sca_frontinfoslider4'); ?>
                                </div>
                            </li>
                        </ul>
                        <nav class="orbit-bullets">
                            <button class="is-active" data-slide="0"><span class="show-for-sr">First slide details.</span><span class="show-for-sr">Current Slide</span></button>
                            <button data-slide="1"><span class="show-for-sr">Second slide details.</span></button>
                            <button data-slide="2"><span class="show-for-sr">Third slide details.</span></button>
                            <button data-slide="3"><span class="show-for-sr">Fourth slide details.</span></button>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
