<?php
	/**
	 * Created by Chris Wilkinson.
	 * Title: oop
	 * Date: 26/05/2018
	 * Time: 12:16
	 */


	?>


<div class="top-bar">
    <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
            <li class="menu-text"><a href="<?php echo e(sca_get_preference('showcase', 'sca_siteurl')); ?>" rel="" target="_self" hreflang="en"><?php echo e(sca_get_preference('showcase', 'sca_sitename')); ?></a></li>
        </ul>
    </div>
    <div class="top-bar-right">
        <ul class="dropdown menu" data-dropdown-menu>
            <li><a href="/">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="#contact" data-smooth-scroll>Contact</a></li>
            <li><a href="/sc-panel/login">Login</a></li>
        </ul>
    </div>
</div>
